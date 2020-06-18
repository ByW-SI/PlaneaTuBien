<?php

namespace App\Http\Controllers\Pagos;

use App\Contrato;
use App\DepositoEfectivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mensualidad;
use App\Pagos;
use Illuminate\Support\Carbon;
use App\Refdepositopago;

class PagoDepositoController extends Controller
{
    public function store(Request $request){

        $deposito = DepositoEfectivo::find($request->input('deposito_id'));
        // dd($deposito);
        $deposito->update(['motonasig'=>($request->input('input_abono')+$deposito->motonasig)]);
        $contrato = Contrato::find($request->input('contrato_id'));
        // dd($contrato);
        $mensualidad = $contrato->mensualidades()->last()->first();
        // dd($mensualidad);

        $pago = Pagos::create([
            'contrato_id' =>$contrato->id,
            'monto'=> $request->input('input_abono'),
            'fecha_pago'=> Carbon::now(),
            'status_id'=>1,
            'tipopago_id'=>2,
            'referencia'=>'-',
            'mensualidad_id'=>$mensualidad->id,
        ]);
        $refdepositopago= Refdepositopago::create([
            'deposito_efectivo_id'=>$request->input('deposito_id'),
            'pago_id'=>$pago->id
        ]);

        //$this->actualizarMensualidad($mensualidad->id);
        //dd($deposito->refdepositopago);
        return redirect()->route('pagos.realizados')->with('status','Se agregó el pago adecuadamente');
    }

    public function actualizarMensualidad($mensualidad_id)
    {

        $adeudo_siguiente_mes = 0;
        $abono_siguiente_mes = 0;

        $mensualidad = Mensualidad::where('id',$mensualidad_id)->first();
        // dd($mensualidad);
        $pagos_aprobados_de_mensualidad = $mensualidad->pagos()->aprobados()->get();
        // dd($pagos_aprobados_de_mensualidad);

        $total_pagado_a_mensualidad = 0;
        foreach($pagos_aprobados_de_mensualidad as $pago){
            $total_pagado_a_mensualidad += $pago->monto;
        }
        // dd($total_pagado_a_mensualidad);

        $total_debe = $mensualidad->cantidad + $mensualidad->recargo - $mensualidad->abono;

        // dd($total_debe);

        if($total_pagado_a_mensualidad >= $total_debe){
            // dd('entro');
            $mensualidad->update([
                "pagado" => 1,
            ]);
            // dd($mensualidad);
        }else{
            // dd('no entro');
        }

        return $mensualidad;
    }
    public function get_pagos_referenciados(Request $request)
    {
        $deposito = DepositoEfectivo::find($request->input('deposito_id'));

        $ajaxPagos=array();
        foreach ($deposito->refdepositopago as $refdepositopago) {
            array_push ($ajaxPagos,[$refdepositopago->pago->contrato->grupo_id,$refdepositopago->pago->contrato->numero_contrato,$refdepositopago->pago->monto,"<div class='d-flex justify-content-center'>
                                            <a 
                                            onclick='eliminarPago(".$refdepositopago->pago->id.",".$request->input('deposito_id').")' 
                                            class='btn btn-primary'>Eliminar Pago</a>
                                        </div>"]);
        }
        return json_encode(['data'=> $ajaxPagos]);
    }
    

    public function get_pagos_referenciados_eliminar(Request $request)
    {
        $deposito = DepositoEfectivo::find($request->input('deposito_id'));
        $Refdeposito= Refdepositopago::where("pago_id",$request->input('id'))->get();
        $Refdeposito=$Refdeposito[0];

        $Pago=Pagos::find($request->input('id'));
        if (isset($Pago)) {
            # code...
            $deposito->update(['motonasig'=>$deposito->motonasig-$Pago->monto]);
            $Refdeposito->delete();
            $Pago->delete();

        }
        return redirect()->back();
       /*
        //actualizar cuando se tenga la programacion de los planes 
        $ajaxPagos=array();
        foreach ($deposito->refdepositopago as $refdepositopago) {
            array_push ($ajaxPagos,[$refdepositopago->pago->contrato->grupo_id,$refdepositopago->pago->contrato->numero_contrato,$refdepositopago->pago->monto,"<div class='d-flex justify-content-center'>
                                            <a 
                                            onclick='eliminarPago(".$refdepositopago->pago->id.",".$request->input('deposito_id').")' 
                                            class='btn btn-primary'>Eliminar Pago</a>
                                        </div> boton Eliminar"]);
        }
        return json_encode(['data'=> $ajaxPagos]);
        */
    }
}
