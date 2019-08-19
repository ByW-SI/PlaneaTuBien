<?php

namespace App\Http\Controllers;

use App\DepositoEfectivo;
use App\Pagos;
use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{
    public function detalle(Request $request)
    {
        // dd($request->input());
        $deposito_efectivo = DepositoEfectivo::where('id',$request->input('deposito_id'))->first();
        $cliente = $deposito_efectivo->contrato()->first()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        $edit = false;
        return view('pagos.detalles.show',compact('deposito_efectivo', 'cliente', 'plan', 'edit'));
    }

    public function edit(DepositoEfectivo $deposito_efectivo)
    {
    	$deposito_efectivo = $deposito_efectivo;//DepositoEfectivo::where('id',$request->input('deposito_id'))->first();
        $cliente = $deposito_efectivo->contrato()->first()->presolicitud;
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
       	$edit = true;
        return view('pagos.detalles.show',compact('deposito_efectivo', 'cliente', 'plan', 'edit'));	
    }

    public function validarPago(Request $request)
    {
    	//return response()->json($request->all());
    	$pago = Pagos::where('referencia', $request->referencia)->where('monto', $request->monto_pagado)->first();
    	if (isset($pago)) {
    		$pago->status_id = 1;
    		$pago->save();
    		$deposito = DepositoEfectivo::where('id', $request->deposito_id);
    		$deposito->delete();
    		return response()->json(["estado"=>"ok"]);
    	}
    	return response()->json(["estado"=>"fail"]);
    	
    }

    public function rechazarPago(Request $request)
    {
    	$pago = Pagos::where('referencia', $request->referencia)->where('monto', $request->monto_pagado)->first();
    	if (isset($pago)) {
    		$pago->status_id = 3;
    		$pago->save();
    		return response()->json(['estado'=>"ok"]);
    	}
    	return response()->json(['estado'=>"fail"]);
    }
}
