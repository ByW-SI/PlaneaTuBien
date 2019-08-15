<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Contrato;
use App\Pagos;
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
        return redirect()->route('cliente.dashboard');
        dd($pago);
    }

    public function storePagoEfectivo(Request $request)
    {
        $referencias = $request->input('referencia');
        $contratos = $request->input('contrato');
        $montos = $request->input('monto');
        $files_comprobantes = $request->input('file_comprobante');

        for ($i = 0; $i < count($referencias); $i++) {
            $adeudo = (($request->monto[$i] * 0.03) + ($request->monto[$i] * 0.03) * 0.16);
            $pago = Pagos::create([
                'contrato_id' => substr($contratos[$i], -1),
                'monto' => $montos[$i],
                'fecha_pago' => $request->input('fecha_pago'),
                'adeudo' => $adeudo,
                'total' => ($request->monto[$i] + $adeudo),
                'folio' => $request->input('folio'),
                'status_id' => 2,
                'tipopago_id' => 2,
                'referencia' => $referencias[$i],
                'spei' => $request->input('spei'),
                'file_comprobante' => $files_comprobantes[$i],
            ]);

            if($request->hasfile('file_comprobante')) 
            { 
              $file = $request->file('file_comprobante')[$i];
              $extension = $file->getClientOriginalExtension();
              $filename =$pago->id.'.'.$extension;
              $file->move('contratos/', $filename);
              $pago->update(['file_comprobante' => $filename]);
            }
        }
    }

    /**  2742.187195643
    *2742.187195643
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
