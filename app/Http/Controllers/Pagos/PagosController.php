<?php

namespace App\Http\Controllers\Pagos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mensualidad;
use App\Pagos;
use App\StatusPago;

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
        $status=StatusPago::all();

        return view('pagos.realizados.index', compact('pagos','total_monto_pagado','status'));
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
        $PagoVoucher="Sin Voucher";
        foreach ($Pagos as $Pago) {
            $boton='<a  type="button" class="btn btn-primary verVoucherBTN"  value="'.$Pago->id.'" onclick="Accion_verVoucherBTN('.$Pago->id.')" >
                                      Cargar
                                </a>';
            if ($Pago->voucher) {
                $PagoVoucher="Con Voucher";
            }else{
                $PagoVoucher="Sin Voucher";
            }
            array_push ($ajaxPagos,[ $Pago->folio,$Pago->fecha_pago,$Pago->status_id,$Pago->tipopago_id,$Pago->referencia,$Pago->monto,$PagoVoucher,$boton]);
        }
        return json_encode(['data'=> $ajaxPagos]);

    }
    public function actualizarStatus(Request $request)
    {
        $Pagos=Pagos::where("id",$request->input('pago_id'))->get();
        $Pago=$Pagos[0];
        if ($Pago) {
            $Pago->update(['status_id' => $request->input('status') ]);
        }
        return back()->withInput();
    }

}
