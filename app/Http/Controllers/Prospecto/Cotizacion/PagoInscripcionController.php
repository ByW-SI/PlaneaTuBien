<?php

namespace App\Http\Controllers\Prospecto\Cotizacion;

use App\Cotizacion;
use App\Http\Controllers\Controller;

use App\PagoInscripcion;
use App\Banco;
use App\Prospecto;
use App\Services\Pago\PagarInscripcionService;
use Illuminate\Http\Request;


class PagoInscripcionController extends Controller
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
        return view('prospectos.perfil.pagos.index', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto, Cotizacion $cotizacion)
    {
        $bancos = Banco::orderBy('nombre', 'asc')->get();
        // $folio = strtoupper(substr("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", mt_rand(0, 51), 1).substr(md5(time().$prospecto->id.$cotizacion->id), 1));
        $folio = $prospecto->id . $cotizacion->plan->abreviatura . $cotizacion->id . sizeof($cotizacion->pago_inscripcions);
        return view('prospectos.perfil.pagos.form', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion, 'bancos' => $bancos, 'edit' => false, 'folio' => $folio]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Cotizacion $cotizacion, Request $request)
    {
        $pagarInscripcionService = new PagarInscripcionService($prospecto, $cotizacion, $request);
        
        return redirect()->route('prospectos.cotizacions.pagos.index', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(PagoInscripcion $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(PagoInscripcion $pago)
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
    public function update(Request $request, PagoInscripcion $pago)
    {
        dd('aqui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagoInscripcion $pago)
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
}
