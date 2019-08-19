<?php

namespace App\Http\Controllers;

use App\DepositoEfectivo;
use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{
    public function detalle(Request $request)
    {
        // dd($request->input());
        $deposito_efectivo = DepositoEfectivo::where('id',$request->input('deposito_id'))->first();
        // dd($deposito_efectivo);
        return view('pagos.detalles.show',compact('deposito_efectivo'));
    }
}
