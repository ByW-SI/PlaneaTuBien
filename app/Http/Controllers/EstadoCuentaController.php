<?php

namespace App\Http\Controllers;

use App\DepositoEfectivo;
use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{
    public function detalle(Request $request)
    {
        
        $deposito_efectivo = DepositoEfectivo::where('id', $request->input('deposito_id'))->first();
        $presolicitud=null;
        
        if ($deposito_efectivo->contrato()->first()){
            if ($deposito_efectivo->contrato()->first()->presolicitud()->first()){
                $presolicitud = $deposito_efectivo->contrato()->first()->presolicitud()->first();
            }
        }

        return view('pagos.detalles.show', compact('deposito_efectivo','presolicitud'));
    }
}
