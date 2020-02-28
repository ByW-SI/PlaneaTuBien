<?php

namespace App\Http\Controllers\Cotizacion;

use App\Cotizacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CotizacionController extends Controller
{
    public function updatePlan(Request $request, Cotizacion $cotizacion){
        // dd($cotizacion);
        // dd($request->input());

        // return $cotizacion->perfil->presolicitud;

        $cotizacion->update([
            'plan_id' => $request->input('plan_id')
        ]);
        // $cotizacion->save();
        // dd($cotizacion);
        return redirect()->back();
    }
}
