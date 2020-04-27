<?php

namespace App\Http\Controllers\Prospecto\Cliente\Perfil;

use App\Banco;
use App\PerfilHistorialCrediticioCliente;
use App\Prospecto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistorialCrediticioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerfilHistorialCrediticioCliente  $perfilHistorialCrediticioCliente
     * @return \Illuminate\Http\Response
     */
    public function show(PerfilHistorialCrediticioCliente $perfilHistorialCrediticioCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerfilHistorialCrediticioCliente  $perfilHistorialCrediticioCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto,PerfilHistorialCrediticioCliente $credito)
    {
        //
        $perfil = $prospecto->perfil;
        $bancos = Banco::orderBy('nombre','asc')->get();
        return view('prospectos.perfil.historial_crediticio.form',['prospecto'=>$prospecto,'credito'=>$perfil->historial_crediticio,'perfil'=>$perfil,'cotizacion'=>$perfil->cotizacion,'bancos'=>$bancos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerfilHistorialCrediticioCliente  $perfilHistorialCrediticioCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto,PerfilHistorialCrediticioCliente $credito)
    {
        //
        $perfil = $prospecto->perfil;
        $perfil->historial_crediticio->update(
        [
            'tarjeta_debito'=>$request->tarjeta_debito,
            'tarjeta_credito'=>$request->tarjeta_credito,
            'numero_tarjeta_debito'=>$request->numero_tarjeta_debito,
            'numero_tarjeta_credito'=>$request->numero_tarjeta_credito,
            'tarjetas_credito'=> json_encode($request->tarjetas_credito),
            'tarjetas_debito'=>json_encode($request->tarjetas_debito),
            'en_buro_credito'=>$request->en_buro_credito,
            'buro_credito'=>($request->en_buro_credito ? $request->buro_credito : ""),
            'limite_credito'=>$request->limite_credito,
            'destino_1'=>$request->destino_1,
            'tipo_destino_1'=>$request->tipo_destino_1,
            'monto_destino_1'=>$request->monto_destino_1,
            'destino_2'=>$request->destino_2,
            'tipo_destino_2'=>$request->tipo_destino_2,
            'monto_destino_2'=>$request->monto_destino_2,
            'destino_3'=>$request->destino_3,
            'tipo_destino_3'=>$request->tipo_destino_3,
            'monto_destino_3'=>$request->monto_destino_3,
            'calificacion_credito'=>$request->calificacion_credito,
            'descripcion_calificacion'=>$request->descripcion_calificacion

        ]
    );
        return redirect()->route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerfilHistorialCrediticioCliente  $perfilHistorialCrediticioCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerfilHistorialCrediticioCliente $perfilHistorialCrediticioCliente)
    {
        //
    }
}
