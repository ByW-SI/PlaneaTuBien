<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Pagos;
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
        foreach ($cliente->contratos as $contrato) {
            $pagos[] = Pagos::where('contrato_id', $contrato->id)->get()->last();
        }
        
    	return view('cliente.pagar',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan, 'pagos'=>$pagos]);
    }

    public function confirmarPago(Request $request)
    {
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

    public function guardarPago(Request $request)
    {
        $pago = PagoMensual::create($request->all());
        return redirect()->route('cliente.dashboard');
    }

    public function formDeposito()
    {
        return view('cliente.confirmardeposito');
    }

    public function historial()
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        return view('cliente.plan.historial',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan]);
    }
    

}
