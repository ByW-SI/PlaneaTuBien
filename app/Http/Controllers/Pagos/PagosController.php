<?php

namespace App\Http\Controllers\Pagos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mensualidad;
use App\Pagos;

class PagosController extends Controller
{
    public function index(Request $request)
    {
        $pagos = null;
        $total_monto_pagado = 0;

        if ($request->input()) {
            $pagos = $this->getPagosPorFecha($request);
            $total_monto_pagado = $this->getTotalMontoPagado($pagos);
        }

        return view('pagos.realizados.index', compact('pagos','total_monto_pagado'));
    }

    public function getPagosPorFecha(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_final = $request->input('fecha_final');
        $pagos = Pagos::where('fecha_pago', '>=', $fecha_inicio)->where('fecha_pago', '<=', $fecha_final)->get();
        return $pagos;
    }

    public function getTotalMontoPagado($pagos){

        $total_monto_pagado = 0;
        foreach($pagos as $pago){
            $total_monto_pagado += $pago->monto;
        }

        return $total_monto_pagado;

    }
    public function getHistorial(Request $request){
        $Pagos=Pagos::where("contrato_id",$request->input('id'))->get();
        $ajaxPagos=array();
        foreach ($Pagos as $Pago) {
            array_push ($ajaxPagos,[ $Pago->folio,$Pago->fecha_pago,$Pago->status_id,$Pago->tipopago_id,$Pago->referencia]);
        }
        return json_encode(['data'=> $ajaxPagos]);

    }
}
