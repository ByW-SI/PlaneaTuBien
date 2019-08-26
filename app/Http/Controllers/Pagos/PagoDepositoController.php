<?php

namespace App\Http\Controllers\Pagos;

use App\Contrato;
use App\DepositoEfectivo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return redirect()->route('pagos.realizados')->with('status','Se agregó el pago adecuadamente');
    }
}
