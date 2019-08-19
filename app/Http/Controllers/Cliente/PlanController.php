<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Pagos;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:cliente');
    }


    public function corrida()
    {
    	$cliente = auth('cliente')->user()->presolicitud;
    	$cotizacion=$cliente->cotizacion();
    	$plan = $cotizacion->plan;
    	return view('cliente.plan.corrida',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan]);
    }

    public function formPagos()
    {
    	$cliente = auth('cliente')->user()->presolicitud;
    	$cotizacion=$cliente->cotizacion();
    	$plan = $cotizacion->plan;
        $pagos = [];
        $contratos = [];
        $fecha_pago = $this->isValidFechaPago(Carbon::now());
        foreach ($cliente->contratos as $contrato) {
            if (!is_null(Pagos::where('contrato_id', $contrato->id)->get()->last())) {
                $pagos[$contrato->id] = Pagos::where('contrato_id', $contrato->id)->get()->last();
            }
            else{
                $contratos[] = $contrato;
            }
        }

    	return view('cliente.pagar',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan, 'contratos'=>$contratos, 'pagos'=>$pagos, 'fecha_pago'=>$fecha_pago]);
    }

    public function confirmarPago(Request $request)
    {
        // dd($request->input());
        $montos = $request->recibo;
        $referencias = $request->referencia;
        $total = $request->total;
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        return view('cliente.proceder_pago', [
            'montos'=>$montos, 
            'referencias'=>$referencias,
            'total'=>$total,
            'cliente'=>$cliente, 
            'cotizacion'=>$cotizacion,
            'plan'=>$plan
        ]);
    }

    // public function guardarPago(Request $request)
    // {
    //     $pago = PagoMensual::create($request->all());
    //     return redirect()->route('cliente.dashboard');
    // }

    public function formDeposito()
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        $contratos = $cliente->contratos;
        return view('cliente.confirmardeposito', ['cliente'=>$cliente, 'cotizacion'=>$cotizacion, 'contratos'=>$contratos]);
    }

    public function historial()
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        $pagos = [];
        foreach ($cliente->contratos as $contrato) {
            if (!is_null(Pagos::where('contrato_id', $contrato->id)->get()->last()) ) {
                $pagos[$contrato->id] = Pagos::where('contrato_id', $contrato->id)->get();
            }
        }
        return view('cliente.plan.historial',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan, 'pagos'=>$pagos]);
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
