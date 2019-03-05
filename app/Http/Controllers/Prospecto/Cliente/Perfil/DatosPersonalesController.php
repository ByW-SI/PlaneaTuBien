<?php

namespace App\Http\Controllers\Prospecto\Cliente\Perfil;

use App\PerfilDatosPersonalCliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto, Cotizacion $cotizacion)
    {
        //
        dd($prospecto);
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
     * @param  \App\PerfilDatosPersonalCliente  $perfilDatosPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function show(PerfilDatosPersonalCliente $perfilDatosPersonalCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerfilDatosPersonalCliente  $perfilDatosPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(PerfilDatosPersonalCliente $perfilDatosPersonalCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerfilDatosPersonalCliente  $perfilDatosPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerfilDatosPersonalCliente $perfilDatosPersonalCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerfilDatosPersonalCliente  $perfilDatosPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerfilDatosPersonalCliente $perfilDatosPersonalCliente)
    {
        //
    }
}
