<?php

namespace App\Http\Controllers\Prospecto\Cotizacion;

use App\Cotizacion;
use App\Http\Controllers\Controller;
use App\Events\PagoCreated;
use App\Pago;
use App\Banco;
use App\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto, Cotizacion $cotizacion)
    {
        //
        // dd($prospecto);
        return view('prospectos.perfil.pagos.index',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto, Cotizacion $cotizacion)
    {
        //
        $bancos = Banco::orderBy('nombre','asc')->get();
        $folio = strtoupper(substr("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", mt_rand(0, 51), 1).substr(md5(time().$prospecto->id.$cotizacion->id), 1));
        return view('prospectos.perfil.pagos.form',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion,'bancos'=>$bancos,'edit'=>false,'folio'=>$folio]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Cotizacion $cotizacion,Request $request)
    {
        //
        $rules = [
            'referencia'=>'required|alpha_num',
            'folio'=>'required',
            'identificacion'=>'required|in:INE,Pasaporte,Cédula Profesional,Cartilla,Otro',
            'comprobante'=>'required|in:Luz,Agua,Teléfono,Predial',
            'forma'=>'required|in:Efectivo,Depósito,Cheque,Tarjeta de Crédito,Tarjeta de Débito,Transferencia',
            'monto'=>'required|numeric',
            'total'=>"required|numeric"
        ];
        $this->validate($request,$rules);
        //return dd($request->all());
        $pago = new Pago($request->all());
        $pago->prospecto()->associate($prospecto);
        $cotizacion->pagos()->save($pago);
        event(new PagoCreated($prospecto, $pago, Auth::user()));
        return redirect()->route('prospectos.cotizacions.pagos.index',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }


    /**
     * Update the status resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Prospecto $prospecto, Cotizacion $cotizacion, Pago $pago, Request $request)
    {
        //
        // dd($pago);
         $rules = [
            'status'=>'required|in:registrado,aprobado,rechazado',
        ];
        $this->validate($request,$rules);
        $pago->update([
            'status'=>$request->status
        ]);
        return back();
    }
}
