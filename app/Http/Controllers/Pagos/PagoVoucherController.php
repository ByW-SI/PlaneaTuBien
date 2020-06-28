<?php

namespace App\Http\Controllers\Pagos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pagos;
use UxWeb\SweetAlert\SweetAlert as Alert;

class PagoVoucherController extends Controller
{
    //
     public function cargarVoucher(Request $request)
    {

    	$pago=Pagos::where("id",$request->input("pago_id"))->get();
    	$pago=$pago[0];
       
        if ($request->voucher && $request->file('voucher')->isValid()) {
            $voucher = explode("/",$request->voucher->storeAs('voucher/'.$pago->id, 'voucher.'.$request->voucher->extension(), 'public'));
        }

        if (!isset($voucher)) {
            $voucher=null;
        }else{
            $voucher=$voucher[2];
        }

        //dd($voucher);
        $pago->update(['voucher' => $voucher ]);


        return back()->withInput();
    }
    
    public function pagovoucher_eliminar(Request $request)
    {
    	$pago=Pagos::where("id",$request->input("pago_id2"))->get();
    	$pago=$pago[0];
    	$pago->update(['voucher' => null ]);
    	return back()->withInput();
    }
}
