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

    /**
     * Almacena todos los pagos por cada una de las referencias
     * recibidas, y almacena la imagen de comprobante en la carpeta
     * "public/contratos" con el id del pago
     */

    public function storePagosEfectivos(Request $request)
    {
        $total_referencias = count($request->input('referencia'));

        for ($i = 0; $i < $total_referencias; $i++) {

            $pago = $this->storePagoEfectivo($request, $i);
            $file = $request->file('file_comprobante')[$i];
            $this->storeComprobanteImg($file, $pago);
        }
    }

    /**
     * Almacena el pago en efectivo con el índice recibido
     */

    public function storePagoEfectivo(Request $request, $i)
    {
        $adeudo = (($request->monto[$i] * 0.03) + ($request->monto[$i] * 0.03) * 0.16);

        $pago = Pagos::create([
            'contrato_id' => substr($request->input('contrato')[$i], -1),
            'monto' => $request->input('monto')[$i],
            'fecha_pago' => $request->input('fecha_pago'),
            'adeudo' => $adeudo,
            'total' => ($request->monto[$i] + $adeudo),
            'folio' => $request->input('folio'),
            'status_id' => 2,
            'tipopago_id' => 2,
            'referencia' => $request->input('referencia')[$i],
            'spei' => $request->input('spei'),
            'file_comprobante' => $request->input('file_comprobante')[$i],
        ]);

        return $pago;
    }

    public function storeComprobanteImg($file, Pagos $pago)
    {
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $filename = $pago->id . '.' . $extension;
            $file->move('contratos/', $filename);
            $pago->update(['file_comprobante' => $filename]);
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
