<?php

namespace App\Http\Controllers\Pagos;

use App\Contrato;
use App\DepositoEfectivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mensualidad;
use App\Pagos;
use Illuminate\Support\Carbon;

class PagoDepositoController extends Controller
{
    public function store(Request $request){

        $deposito = DepositoEfectivo::find($request->input('deposito_id'));
        // dd($deposito);
        $contrato = Contrato::find($request->input('contrato_id'));
        // dd($contrato);
        $mensualidad = $contrato->mensualidades()->last()->first();
        // dd($mensualidad);

        $pago = Pagos::create([
            'contrato_id' =>$contrato->id,
            'monto'=> $deposito->abono,
            'fecha_pago'=> Carbon::now(),
            'status_id'=>1,
            'tipopago_id'=>2,
            'referencia'=>'-',
            'mensualidad_id'=>$mensualidad->id,
        ]);

        $this->actualizarMensualidad($mensualidad->id);

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
            dd($mensualidad);
        }else{
            // dd('no entro');
        }

        return $mensualidad;
    }
}
