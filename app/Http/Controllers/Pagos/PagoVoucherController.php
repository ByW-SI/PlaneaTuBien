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
       
        //f ($request->voucher && $request->file('voucher')->isValid()) {
            $voucher = explode("/",$request->voucher->storeAs('voucher/'.$pago->id, 'voucher.'.$request->voucher->extension(), 'public'));
        //}

        if (!isset($voucher)) {
            $voucher=null;
        }else{
            $voucher=$voucher[2];
        }

        $pago->update(['voucher' => $request->input('voucher') ]);


        return back()->withInput();
    }
}
