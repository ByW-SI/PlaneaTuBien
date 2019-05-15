<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
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

    public function pagar()
    {
    	$cliente = auth('cliente')->user()->presolicitud;
    	$cotizacion=$cliente->cotizacion();
    	$plan = $cotizacion->plan;
    	return view('cliente.pagar',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan]);
    }

}
