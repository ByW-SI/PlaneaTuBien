<?php

namespace App\Http\Controllers\Pagos;

use App\DepositoEfectivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuscarReferenciaController extends Controller
{
    public function index(){
        $depositos_efectivos = array();
        return view('pagos.asignar.index',compact('depositos_efectivos'));
    }

    public function show(Request $request){

        $fecha = $request->input('fecha');
        $monto = $request->input('monto');

        $depositos_efectivos = DepositoEfectivo::
            where('dia',$fecha)->
            where('abono',$monto)->
            get();

        return view('pagos.asignar.index',compact('depositos_efectivos'));
    }
}
