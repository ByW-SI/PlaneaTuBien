<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Conyuge;
use App\Presolicitud;
use App\Prospecto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresolicitudConyugeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        //
        // dd($presolicitud);
        $conyuge=$presolicitud->conyuge;
        if($conyuge){
            return view('prospectos.presolicitud.conyuge.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'conyuge'=>$conyuge]);
        }
        else{
            return redirect()->route('prospectos.presolicitud.conyuge.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        //
        return view('prospectos.presolicitud.conyuge.form',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Presolicitud $presolicitud,Request $request)
    {
        //
        // dd($presolicitud);
        $rules=[
            'paterno'=>"required|max:190",
            'materno'=>"nullable|max:190",
            'nombre'=>"required|max:190",
            'fecha_nacimiento'=>"date|required|after:".date('Y-m-d', strtotime('-64 years')),
            'lugar_nacimiento'=>"required|max:190",
            'nacionalidad'=>"required|max:190",
            'tel_casa'=>"required|max:15",
            'tel_oficina'=>"nullable|max:15",
            'tel_celular'=>"nullable|max:15",
            'email'=>"email|required|max:190"
        ];
        $this->validate($request,$rules);
        $conyuge = new Conyuge($request->all());
        $presolicitud->conyuge()->save($conyuge);
        if($presolicitud->conyuge){
            return redirect()->route('prospectos.presolicitud.beneficiarios.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
        // dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function show(Conyuge $conyuge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function edit(Conyuge $conyuge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conyuge $conyuge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conyuge  $conyuge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conyuge $conyuge)
    {
        //
    }
}
