<?php

namespace App\Http\Controllers\Prospecto\Cliente\Perfil;

use App\PerfilReferenciaPersonalCliente;
use App\Prospecto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferenciaPersonalController extends Controller
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
     * @param  \App\PerfilReferenciaPersonalCliente  $perfilReferenciaPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function show(PerfilReferenciaPersonalCliente $perfilReferenciaPersonalCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerfilReferenciaPersonalCliente  $perfilReferenciaPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto,PerfilReferenciaPersonalCliente $referencias)
    {
        //
        $perfil = $prospecto->perfil;
        return view('prospectos.perfil.datos_personal.form',['prospecto'=>$prospecto,'referencias' =>
                    $perfil->referencia_personals,'perfil'=>$perfil,'cotizacion'=>$perfil->cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerfilReferenciaPersonalCliente  $perfilReferenciaPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Prospecto $prospecto, PerfilReferenciaPersonalCliente $referencias)
    {
        //
        $perfil = $prospecto->perfil;

        foreach ($perfil->referencia_personals as $i => $referencia) {
            $referencia->update([
                'nombre' => $request->nombre[$i+1],
                'paterno' => $request->paterno[$i+1],
                'materno' => $request->materno[$i+1],
                'parentesco' => $request->parentesco[$i+1],
                'telefono' =>$request->telefono[$i+1],
                'celular'=>$request->celular[$i+1]
            ]);
        }
        return redirect()->route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerfilReferenciaPersonalCliente  $perfilReferenciaPersonalCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerfilReferenciaPersonalCliente $perfilReferenciaPersonalCliente)
    {
        //
    }
}
