<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Contrato;
use App\Pagos;
use App\EstadoFinanciero;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion = $cliente->cotizacion();
        $plan = $cotizacion->plan;
        $date = Carbon::now();

        //dd($request->all());
        for ($i = 0; $i < count($request->monto); $i++) {

            $contrato = $cliente->contratos()->where('id', $request->contrato[$i])->first();
            if (bccomp($request->monto[$i], $plan->corrida_meses_fijos($contrato->monto)['integrante']['total']) == 0) {
                if ($this->isValidFechaPago($date)) {
                    dd('OK Si pasa el pago');
                } else {
                    //dd('Fail Se paso la fecha de Pago');
                    $adeudo = (($request->monto[$i] * 0.03) + ($request->monto[$i] * 0.03) * 0.16);
                    $folio = str_pad($contrato->grupo->id, 3, "0", STR_PAD_LEFT) . $contrato->numero_contrato;
                    $pago = Pagos::create([
                        'contrato_id' => $request->contrato[$i],
                        'monto' => $request->monto[$i],
                        'fecha_pago' => $date->toDateString(),
                        // El calculo del adeudo es de acuerdo al negocio del monto a pagar se le cobra el 3% mas iva de ese 3%
                        'adeudo' => $adeudo,
                        'total' => ($request->monto[$i] + $adeudo),
                        'folio' => $folio,
                        'status_id' => 2,
                        'tipopago_id' => 1,
                        'referencia' => $request->referencia[$i],
                        'created_at' => $date->toDateTimeString(),
                        'updated_at' => $date->toDateTimeString()
                    ]);
                }
            }
        }
        return redirect()->route('cliente.dashboard')->with('status', "Special message goes here");
    }

    /**
     * Almacena todos los pagos por cada una de las referencias
     * recibidas, y almacena la imagen de comprobante en la carpeta
     * "public/contratos" con el id del pago
     */

    public function storePagosEfectivos(Request $request)
    {
        //dd($request->all());
        $total_referencias = count($request->input('referencia'));

        for ($i = 0; $i < $total_referencias; $i++) {

            $pago = $this->storePagoEfectivo($request, $i);
            $file = $request->file('file_comprobante')[$i];
            $this->storeComprobanteImg($file, $pago);
        }
        return redirect()->route('cliente.dashboard')->with('status', "Special message goes here");
    }

    /**
     * Almacena el pago en efectivo con el índice de la referencia
     * recibida.
     */

    public function storePagoEfectivo(Request $request, $i)
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion = $cliente->cotizacion();
        $plan = $cotizacion->plan;
        $monto_pago = $request->monto[$i];
        $contrato = Contrato::find(substr($request->input('contrato')[$i], 3));

        if ($this->isValidFechaPago($request->fecha_pago)) {
            $monto_contrato = $plan->corrida_meses_fijos($contrato->monto)['integrante']['total'];
        }
        else{
            $monto_contrato = $plan->corrida_meses_fijos($contrato->monto)['integrante']['total'];
            $monto_contrato = $monto_contrato + (($monto_contrato * 0.03) + ($monto_contrato * 0.03) * 0.16);
        }
        /*
        * bccomp devuelve 
        * 0 si son igual
        * 1 si el de la izquierda es mayor que el de la derecha
        * -1 de lo contrario
        */
        $pago = Pagos::create([
            'contrato_id' => $contrato->id,
            'monto' => $monto_pago,
            'fecha_pago' => $request->input('fecha_pago'),
            //'adeudo' => $adeudo,
            //'total' => ($request->monto[$i] + $adeudo),
            'folio' => $request->input('folio'),
            'status_id' => 2,
            'tipopago_id' => 2,
            'referencia' => $request->input('referencia')[$i],
            'spei' => $request->input('spei'),
            'file_comprobante' => $request->input('file_comprobante')[$i],
        ]);
        if(bccomp($monto_pago, $monto_contrato) == -1){
            if ($this->isValidFechaPago($request->fecha_pago)) {
                $adeudo = $monto_contrato - $monto_pago;
                $estadoF = EstadoFinanciero::updateOrCreate(
                    ['contrato_id'=>$contrato->id],
                    ['contrato_id'=>$contrato->id, 'adeudo'=>$adeudo]
                );
                $estadoF->saldo = $estadoF->abono - ($estadoF->adeudo + $estadoF->recargo);
                $estadoF->save();
            }
            else{
                $monto_contrato = $plan->corrida_meses_fijos($contrato->monto)['integrante']['total'];
                $adeudo = $monto_contrato - $monto_pago;
                $recargo = (($monto_contrato * 0.03) + ($monto_contrato * 0.03) * 0.16);
                $estadoF = EstadoFinanciero::updateOrCreate(
                    ['contrato_id'=>$contrato->id],
                    ['contrato_id'=>$contrato->id, 'adeudo'=>$adeudo, 'recargo'=>$recargo]
                );
                $estadoF->saldo = $estadoF->abono - ($estadoF->adeudo + $estadoF->recargo);
                $estadoF->save();
                
            }
        }
        else if(bccomp($monto_pago, $monto_contrato) == 1){
            if ($this->isValidFechaPago($request->fecha_pago)) {
                $abono = $monto_pago - $monto_contrato;
                $estadoF = EstadoFinanciero::updateOrCreate(
                    ['contrato_id'=>$contrato->id],
                    ['contrato_id'=>$contrato->id, 'abono'=>$abono]
                );
                $estadoF->saldo = $estadoF->abono - ($estadoF->adeudo + $estadoF->recargo);
                $estadoF->save();
            }
            else{
                $monto_contrato = $plan->corrida_meses_fijos($contrato->monto)['integrante']['total'];
                $abono = $monto_pago - $monto_contrato;
                $recargo = (($monto_contrato * 0.03) + ($monto_contrato * 0.03) * 0.16);
                if($abono > $recargo){
                    $abono = $abono - $recargo;
                    $recargo = 0;
                }
                elseif($abono < $recargo){
                    $recargo = $recargo - $abono;
                    $abono = 0;
                }
                else {
                    $abono = 0;
                    $recargo = 0;
                }
                $estadoF = EstadoFinanciero::updateOrCreate(
                    ['contrato_id'=>$contrato->id],
                    ['contrato_id'=>$contrato->id, 'abono'=>$abono, 'recargo'=>$recargo]
                );
                $estadoF->saldo = $estadoF->abono - ($estadoF->adeudo + $estadoF->recargo);
                $estadoF->save();
                
            }
        }

        

        return $pago;
    }

    /**
     * Almacena la imagen del comprobante de pago en la carpeta
     * "public/img/comprobantes/" con el id del pago almacenado
     */

    public function storeComprobanteImg($file, Pagos $pago)
    {
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $filename = $pago->id . '.' . $extension;
            $file->move('contratos/', $filename);
            $pago->update(['file_comprobante' => $filename]);
        }
    }

    /** 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function isValidFechaPago($fecha)
    {
        $start = new Carbon('first day of this month');
        $end = $start->addDay(6);

        while ($end->englishDayOfWeek === "Saturday" || $end->englishDayOfWeek === "Sunday") {
            /*
            Aqui ira la condicion de la precarga de dias feriados
            */
            $end->addDay();
        }
        if ($start->lessThanOrEqualTo($fecha) && $end->greaterThanOrEqualTo($fecha))
            return true;
        else
            return false;
    }
}
