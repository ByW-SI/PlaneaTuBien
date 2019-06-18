<?php

namespace App\Http\Controllers\Prospecto\Cliente\Perfil;


use App\Http\Controllers\Controller;
use App\PerfilDatosPersonalCliente;
use App\Prospecto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class DatosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto)
    {
        //
        $perfil = $prospecto->perfil;
        return view('prospectos.perfil.index',['prospecto'=>$prospecto,'perfil'=>$perfil,'cotizacion'=>$perfil->cotizacion]);
    }

    /**
     * Display the archive pdf for perfil.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf(Prospecto $prospecto)
    {
        //
        $perfil = $prospecto->perfil;
        // return view('prospectos.perfil.pdf',['perfil'=>$perfil]);
        $pdf = PDF::loadView('prospectos.perfil.pdf',['perfil'=>$perfil]);
        return $pdf->download('perfil ' . $prospecto->nombre . '.pdf');
        // dd($perfil);
        // return view('prospectos.perfil.index',['perfil'=>$perfil]);
    }
    /**
     * Display the archive pdf for presolicitud.
     *
     * @return \Illuminate\Http\Response
     */
    public function presolicitud(Prospecto $prospecto)
    {
        //
        $perfil = $prospecto->perfil;
        // return view('prospectos.perfil.pdf',['perfil'=>$perfil]);
        $pdf = PDF::loadView('prospectos.presolicitud.pdf',['perfil'=>$perfil]);
        return $pdf->stream();
        // dd($perfil);
        // return view('prospectos.perfil.index',['perfil'=>$perfil]);
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
    public function edit(Prospecto $prospecto,PerfilDatosPersonalCliente $datos_personal)
    {
        //
        $perfil = $prospecto->perfil;
        return view('prospectos.perfil.datos_personal.form',['prospecto'=>$prospecto,'datos_personal'=>$datos_personal,'perfil'=>$perfil,'cotizacion'=>$perfil->cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerfilDatosPersonalCliente  $perfilDatosPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto, PerfilDatosPersonalCliente $datos_personal)
    {
        //
        $datos_personal->update($request->all());
        return redirect()->route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]);

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
