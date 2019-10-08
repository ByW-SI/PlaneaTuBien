<?php

namespace App\Http\Controllers\Empleado;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospecto;
use App\Plan;
use App\Promocion;

class ActualizacionPlanProspectoController extends Controller
{
    public function index(Prospecto $prospecto)
    {
    	$planes = Plan::get();
    	$promociones = Promocion::get();
    	return view('empleado.prospecto.cambioplan.index', ['prospecto'=>$prospecto, 'planes'=>$planes, 'promociones'=>$promociones]);
    }
}
