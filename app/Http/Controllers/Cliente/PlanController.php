<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:cliente');
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
    	return view('cliente.prueba',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan]);
    }

    public function guardarPago(Request $request)
    {
        $pago = PagoMensual::create($request->all());
        return redirect()->route('cliente.dashboard');
    }

    public function historial()
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        return view('cliente.plan.historial',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan]);
    }

    public function layout()
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        return view('cliente.prueba',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan]);
    }
    

}
