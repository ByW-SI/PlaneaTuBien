<?php

namespace App\Http\Controllers\Prospecto\Cliente;

use App\ChecklistFolder;
use App\Presolicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChecklistFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Presolicitud $presolicitud)
    {
        //
        if ($presolicitud->checklist) {
            return view('prospectos.checklist.index',['presolicitud'=>$presolicitud]);
        } else {
            return redirect()->route('presolicituds.checklist.create',['presolicitud'=>$presolicitud]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Presolicitud $presolicitud)
    {
        //
        return view('prospectos.checklist.form',['presolicitud'=>$presolicitud]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Presolicitud $presolicitud,Request $request)
    {
        //
        if ($request->file('ficha_deposito_path')->isValid()) {
            $ficha_deposito_path = $request->ficha_deposito_path->storeAs('presolicitud/'.$presolicitud->id, 'ficha_deposito.'.$request->ficha_deposito_path->extension(), 'public');
        }
        if ($request->file('perfil_path')->isValid()) {
            $perfil_path = $request->perfil_path->storeAs('presolicitud/'.$presolicitud->id, 'perfil.'.$request->perfil_path->extension(), 'public');
        }
        if ($request->file('presolicitud_path')->isValid()) {
            $presolicitud_path = $request->presolicitud_path->storeAs('presolicitud/'.$presolicitud->id, 'presolicitud.'.$request->presolicitud_path->extension(), 'public');
        }
        if ($request->file('contrato_path')->isValid()) {
            $contrato_path = $request->contrato_path->storeAs('presolicitud/'.$presolicitud->id, 'contrato.'.$request->contrato_path->extension(), 'public');
        }
        if ($request->file('hoja_aceptacion_path')->isValid()) {
            $hoja_aceptacion_path = $request->hoja_aceptacion_path->storeAs('presolicitud/'.$presolicitud->id, 'hoja_aceptacion.'.$request->hoja_aceptacion_path->extension(), 'public');
        }
        if ($request->file('manual_consumidor_path')->isValid()) {
            $manual_consumidor_path = $request->manual_consumidor_path->storeAs('presolicitud/'.$presolicitud->id, 'manual_consumidor.'.$request->manual_consumidor_path->extension(), 'public');
        }
        if ($request->file('calidad_path')->isValid()) {
            $calidad_path = $request->calidad_path->storeAs('presolicitud/'.$presolicitud->id, 'calidad.'.$request->calidad_path->extension(), 'public');
        }
        if ($request->file('privacidad_path')->isValid()) {
            $privacidad_path = $request->privacidad_path->storeAs('presolicitud/'.$presolicitud->id, 'privacidad_path.'.$request->privacidad_path->extension(), 'public');
        }
        if ($request->file('copia_ficha_deposito_path')->isValid()) {
            $copia_ficha_deposito_path = $request->copia_ficha_deposito_path->storeAs('presolicitud/'.$presolicitud->id, 'copia_ficha_deposito.'.$request->copia_ficha_deposito_path->extension(), 'public');
        }
        if ($request->file('identificacion_path')->isValid()) {
            $identificacion_path = $request->identificacion_path->storeAs('presolicitud/'.$presolicitud->id, 'identificacion.'.$request->identificacion_path->extension(), 'public');
        }
        if ($request->file('comprobante_domicilio_path')->isValid()) {
            $comprobante_domicilio_path = $request->comprobante_domicilio_path->storeAs('presolicitud/'.$presolicitud->id, 'comprobante_domicilio.'.$request->comprobante_domicilio_path->extension(), 'public');
        }
        if ($request->file('croquis_ubicacion_path')->isValid()) {
            $croquis_ubicacion_path = $request->croquis_ubicacion_path->storeAs('presolicitud/'.$presolicitud->id, 'croquis.'.$request->croquis_ubicacion_path->extension(), 'public');
        }
        if ($request->file('carta_bienvenida_path')->isValid()) {
            $carta_bienvenida_path = $request->carta_bienvenida_path->storeAs('presolicitud/'.$presolicitud->id, 'carta_bienvenida.'.$request->carta_bienvenida_path->extension(), 'public');
        }
        if ($request->file('anexos_path')->isValid()) {
            $anexos_path = $request->anexos_path->storeAs('presolicitud/'.$presolicitud->id, 'anexo.'.$request->anexos_path->extension(), 'public');
        }
        $checklist = ChecklistFolder::updateOrCreate([
            'presolicitud_id'=>$presolicitud->id
        ],[
            'ficha_deposito_path'=>$ficha_deposito_path,
            'perfil_path'=>$perfil_path,
            'presolicitud_path'=>$presolicitud_path,
            'contrato_path'=>$contrato_path,
            'hoja_aceptacion_path'=>$hoja_aceptacion_path,
            'manual_consumidor_path'=>$manual_consumidor_path,
            'calidad_path'=>$calidad_path,
            'privacidad_path'=>$privacidad_path,
            'copia_ficha_deposito_path'=>$copia_ficha_deposito_path,
            'identificacion_path'=>$identificacion_path,
            'comprobante_domicilio_path'=>$comprobante_domicilio_path,
            'croquis_ubicacion_path'=>$croquis_ubicacion_path,
            'carta_bienvenida_path'=>$carta_bienvenida_path,
            'anexos_path'=>$anexos_path
        ]);
        return redirect()->route('presolicituds.checklist.index',['presolicitud'=>$presolicitud]);
        // dd($ficha_deposito_path );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChecklistFolder  $checklistFolder
     * @return \Illuminate\Http\Response
     */
    public function show(Presolicitud $presolicitud,ChecklistFolder $checklistFolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChecklistFolder  $checklistFolder
     * @return \Illuminate\Http\Response
     */
    public function edit(Presolicitud $presolicitud,ChecklistFolder $checklistFolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChecklistFolder  $checklistFolder
     * @return \Illuminate\Http\Response
     */
    public function update(Presolicitud $presolicitud,Request $request, ChecklistFolder $checklistFolder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChecklistFolder  $checklistFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presolicitud $presolicitud,ChecklistFolder $checklistFolder)
    {
        //
    }
}
