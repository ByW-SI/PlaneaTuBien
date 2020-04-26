<?php

namespace App\Http\Controllers\Prospecto\Cliente\Perfil;

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
        return view('prospectos.perfil.historial_crediticio.form',['prospecto'=>$prospecto,'credito'=>$credito,'perfil'=>$perfil,'cotizacion'=>$perfil->cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerfilHistorialCrediticioCliente  $perfilHistorialCrediticioCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto,PerfilHistorialCrediticioCliente $perfilHistorialCrediticioCliente)
    {
        //
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
