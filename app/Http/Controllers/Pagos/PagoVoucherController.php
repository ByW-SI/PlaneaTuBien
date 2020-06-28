<?php

namespace App\Http\Controllers\Pagos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pagos;

class PagoVoucherController extends Controller
{
    //
     public function store(Request $request, Pagos $pago)
    {
       
        if ($request->voucher && $request->file('voucher')->isValid()) {
            $voucher = explode("/",$request->voucher->storeAs('voucher/'.$pago->id, 'voucher.'.$request->voucher->extension(), 'public'));
        }

        if (!isset($voucher)) {
            $voucher=null;
        }else{
            $voucher=$voucher[2];
        }

        $pago->update(['voucher' => $request->input('voucher') ]);


        return back()->withInput();
    }
}
