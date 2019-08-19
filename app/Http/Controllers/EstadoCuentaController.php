<?php

namespace App\Http\Controllers;

use App\DepositoEfectivo;
use App\Pagos;
use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{

    /**
     * Mostramos el detalle de uno de los estados de cuenta
     */

    public function detalle(Request $request)
    {
        // dd($request->input());
        $deposito_efectivo = DepositoEfectivo::where('id',$request->input('deposito_id'))->first();
        $cliente = $this->getPresolicitudByDepositoEfectivo($deposito_efectivo);
        $presolicitud = $this->getPresolicitudByDepositoEfectivo($deposito_efectivo);
        $cotizacion=$cliente->cotizacion();
        $plan = $cotizacion->plan;
        $edit = false;
        $pago = Pagos::where('referencia', $deposito_efectivo->concepto)->first();

        return view('pagos.detalles.show', compact('deposito_efectivo', 'presolicitud', 'pago','cliente', 'plan', 'edit'));
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

    /**
     * A partir del deposito en efectivo, obtenemos el contrato,
     * posteriormente, del contrato obtenemos la presolicitud
     * s
     * @param DepositoEfectivo $deposito_efectivo
     * @return Presolicitud $presolicitud
     */

    public function getPresolicitudByDepositoEfectivo($deposito_efectivo)
    {
        $presolicitud = null;
        if ($deposito_efectivo->contrato()->first()) {
            if ($deposito_efectivo->contrato()->first()->presolicitud()->first()) {
                $presolicitud = $deposito_efectivo->contrato()->first()->presolicitud()->first();
            }
        }
        return $presolicitud;
    }
}
