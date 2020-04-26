<?php

namespace App\Http\Controllers\Prospecto\Cliente\Perfil;

use App\PerfilInmueblePretendidoCliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InmueblePretendidoController extends Controller
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
     * @param  \App\PerfilInmueblePretendidoCliente  $perfilInmueblePretendidoCliente
     * @return \Illuminate\Http\Response
     */
    public function show(PerfilInmueblePretendidoCliente $perfilInmueblePretendidoCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerfilInmueblePretendidoCliente  $perfilInmueblePretendidoCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto,PerfilInmueblePretendidoCliente $inmueble)
    {
        //
        $perfil = $prospecto->perfil;
        return view('prospectos.perfil.inmueble_pretendido.form',['prospecto'=>$prospecto,'inmueble'=>$perfil->inmueble_pretendido,'perfil'=>$perfil,'cotizacion'=>$perfil->cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerfilInmueblePretendidoCliente  $perfilInmueblePretendidoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto,PerfilInmueblePretendidoCliente $inmueble)
    {
        //
        $perfil = $prospecto->perfil;
        $perfil->inmueble_pretendido->update($request->all());
        return redirect()->route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerfilInmueblePretendidoCliente  $perfilInmueblePretendidoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerfilInmueblePretendidoCliente $perfilInmueblePretendidoCliente)
    {
        //
    }
}
