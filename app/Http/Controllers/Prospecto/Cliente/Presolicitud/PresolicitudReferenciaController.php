<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Grupo;
use App\Referencia;
use App\Prospecto;
use App\Presolicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Referencia\StoreReferenciaService;

class PresolicitudReferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        //
         if ($presolicitud->referencias->isNotEmpty()) {
            return view('prospectos.presolicitud.referencia.index',['presolicitud'=>$presolicitud,'prospecto'=>$prospecto]);
        }
        else{
            return redirect()->route('prospectos.presolicitud.referencias.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        $grupos = Grupo::get();
        return view('prospectos.presolicitud.referencia.form',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud, 'grupos' => $grupos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Presolicitud $presolicitud,Request $request)
    {
        $storeReferenciaService = new StoreReferenciaService($prospecto, $presolicitud, $request);
        return redirect()->route('prospectos.presolicitud.contratos.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return redirect()->route('prospectos.presolicitud.recibos.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referencia  $referencia
     * @return \Illuminate\Http\Response
     */
    public function show(Referencia $referencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referencia  $referencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Referencia $referencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referencia  $referencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referencia $referencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referencia  $referencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referencia $referencia)
    {
        //
    }
}
