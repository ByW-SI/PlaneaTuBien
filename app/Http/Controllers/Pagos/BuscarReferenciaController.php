<?php

namespace App\Http\Controllers\Pagos;

use App\DepositoEfectivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Presolicitud;
use Carbon\Carbon;

class BuscarReferenciaController extends Controller
{
    public function index(){
        //$depositos_efectivos = array();
        $depositos_efectivos = DepositoEfectivo::
            whereMonth('dia',Carbon::now()->addMonth())
            ->get();
        $clientes = null;
        return view('pagos.asignar.index',compact('depositos_efectivos','clientes'));
    }

    public function show(Request $request){

        $fecha = $request->input('fechaD');
        $monto = $request->input('monto');
        //dd(Carbon::parse($request->input('fechaM')."-01")->addMonth());
        if ($request->input('fechaD')==null&&$request->input('fechaM')==null) {
            # code...
            $depositos_efectivos = DepositoEfectivo::
            get();
        }elseif($request->input('fechaM')!=null){
            $depositos_efectivos = DepositoEfectivo::
            whereMonth('dia',Carbon::parse($request->input('fechaM')."-01")->addMonth())
            ->get();
        }else{
            $depositos_efectivos = DepositoEfectivo::
            where('dia',$fecha)->
            orwhere('abono',$monto)->
            get();
        }

       /* if (isset($request->input('monto') && $request->input('fecha'))) {*/
            
        /*}elseif (isset($request->input('monto'))) {
            $depositos_efectivos = DepositoEfectivo::
            where('dia',$fecha)->
            get();
        }elseif (isset($request->input('fecha'))) {
            $depositos_efectivos = DepositoEfectivo::
            where('abono',$monto)->
            get();
        }else{
            $depositos_efectivos = DepositoEfectivo::
            get();
        }*/
        

        $clientes = Presolicitud::get();

        return view('pagos.asignar.index',compact('depositos_efectivos','clientes'));
    }
}
