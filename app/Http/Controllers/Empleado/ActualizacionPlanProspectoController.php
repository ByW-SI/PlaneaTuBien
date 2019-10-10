<?php

namespace App\Http\Controllers\Empleado;

use App\Cotizacion;
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

    public function update(Request $request, Prospecto $prospecto, Cotizacion $cotizacion){
        // dd($cotizacion);
        // dd($request->input());
        // dd($prospecto->cotizaciones);

        $cotizacion->update([
            'plan_id' => $request->input('plan'),
            'monto' => str_replace(",","",$request->input('monto')),
            'ahorro' => $request->input('ahorro'),
            'descuento' => $request->input('descuento'),
            'promocion_id' => $request->input('promocion'),
            'tipo_inscripcion' => $request->input('tipo_inscripcion'),
        ]);

        return redirect()->back()->with('status','¡El cambio de plan ha sido realizado exitosamente!');
    }
}
