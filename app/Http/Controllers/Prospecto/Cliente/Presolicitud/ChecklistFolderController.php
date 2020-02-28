<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\ChecklistFolder;
use App\Http\Controllers\Controller;
use App\Contrato;
use App\Integrante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ChecklistFolderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contrato $contrato)
    {
        //
        if ($contrato->checklist) {
            $presolicitud = $contrato->presolicitud;
            return view('prospectos.checklist.index',['presolicitud'=>$presolicitud,'contrato'=>$contrato]);
        } else {
            return redirect()->route('contratos.checklist.create',['contrato'=>$contrato]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Contrato $contrato)
    {
        //
        $presolicitud = $contrato->presolicitud;
        // dd($presolicitud);
        return view('prospectos.checklist.form',['presolicitud'=>$presolicitud,'contrato'=>$contrato]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Contrato $contrato, Request $request)
    {
        $checklist_array = array();
        if ($request->ficha_deposito_path && $request->file('ficha_deposito_path')->isValid()) {
            $ficha_deposito_path = $request->ficha_deposito_path->storeAs('contrato/'.$contrato->id, 'ficha_deposito.'.$request->ficha_deposito_path->extension(), 'public');
            $checklist_array['ficha_deposito_path']=$ficha_deposito_path;
        }
        if ($request->perfil_path && $request->file('perfil_path')->isValid()) {
            $perfil_path = $request->perfil_path->storeAs('contrato/'.$contrato->id, 'perfil.'.$request->perfil_path->extension(), 'public');
            $checklist_array['perfil_path']=$perfil_path;
        }
        if ($request->presolicitud_path && $request->file('presolicitud_path')->isValid()) {
            $presolicitud_path = $request->presolicitud_path->storeAs('contrato/'.$contrato->id, 'presolicitud.'.$request->presolicitud_path->extension(), 'public');
            $checklist_array['presolicitud_path']=$presolicitud_path;
        }
        if ($request->contrato_path && $request->file('contrato_path')->isValid()) {
            $contrato_path = $request->contrato_path->storeAs('contrato/'.$contrato->id, 'contrato.'.$request->contrato_path->extension(), 'public');
            $checklist_array['contrato_path']=$contrato_path;
        }
        if ($request->hoja_aceptacion_path && $request->file('hoja_aceptacion_path')->isValid()) {
            $hoja_aceptacion_path = $request->hoja_aceptacion_path->storeAs('contrato/'.$contrato->id, 'hoja_aceptacion.'.$request->hoja_aceptacion_path->extension(), 'public');
            $checklist_array['hoja_aceptacion_path']=$hoja_aceptacion_path;
        }
        if ($request->manual_consumidor_path && $request->file('manual_consumidor_path')->isValid()) {
            $manual_consumidor_path = $request->manual_consumidor_path->storeAs('contrato/'.$contrato->id, 'manual_consumidor.'.$request->manual_consumidor_path->extension(), 'public');
            $checklist_array['manual_consumidor_path']=$manual_consumidor_path;
        }
        if ($request->calidad_path && $request->file('calidad_path')->isValid()) {
            $calidad_path = $request->calidad_path->storeAs('contrato/'.$contrato->id, 'calidad.'.$request->calidad_path->extension(), 'public');
            $checklist_array['calidad_path']=$calidad_path;
        }
        if ($request->privacidad_path && $request->file('privacidad_path')->isValid()) {
            $privacidad_path = $request->privacidad_path->storeAs('contrato/'.$contrato->id, 'privacidad_path.'.$request->privacidad_path->extension(), 'public');
            $checklist_array['privacidad_path']=$privacidad_path;
        }
        if ($request->copia_ficha_deposito_path && $request->file('copia_ficha_deposito_path')->isValid()) {
            $copia_ficha_deposito_path = $request->copia_ficha_deposito_path->storeAs('contrato/'.$contrato->id, 'copia_ficha_deposito.'.$request->copia_ficha_deposito_path->extension(), 'public');
            $checklist_array['copia_ficha_deposito_path']=$copia_ficha_deposito_path;
        }
        if ($request->identificacion_path && $request->file('identificacion_path')->isValid()) {
            $identificacion_path = $request->identificacion_path->storeAs('contrato/'.$contrato->id, 'identificacion.'.$request->identificacion_path->extension(), 'public');
            $checklist_array['identificacion_path']=$identificacion_path;
        }
        if ($request->comprobante_domicilio_path && $request->file('comprobante_domicilio_path')->isValid()) {
            $comprobante_domicilio_path = $request->comprobante_domicilio_path->storeAs('contrato/'.$contrato->id, 'comprobante_domicilio.'.$request->comprobante_domicilio_path->extension(), 'public');
            $checklist_array['comprobante_domicilio_path']=$comprobante_domicilio_path;
        }
        if ($request->croquis_ubicacion_path && $request->file('croquis_ubicacion_path')->isValid()) {
            $croquis_ubicacion_path = $request->croquis_ubicacion_path->storeAs('contrato/'.$contrato->id, 'croquis.'.$request->croquis_ubicacion_path->extension(), 'public');
            $checklist_array['croquis_ubicacion_path']=$croquis_ubicacion_path;
        }
        if ($request->carta_bienvenida_path && $request->file('carta_bienvenida_path')->isValid()) {
            $carta_bienvenida_path = $request->carta_bienvenida_path->storeAs('contrato/'.$contrato->id, 'carta_bienvenida.'.$request->carta_bienvenida_path->extension(), 'public');
            $checklist_array['carta_bienvenida_path']=$carta_bienvenida_path;
        }
        if ($request->anexos_path && $request->file('anexos_path')->isValid()) {
            $anexos_path = $request->anexos_path->storeAs('contrato/'.$contrato->id, 'anexo.'.$request->anexos_path->extension(), 'public');
            $checklist_array['anexos_path']=$anexos_path;
        }
        // dd($checklist_array);
        $checklist = ChecklistFolder::updateOrCreate([
            'contrato_id'=>$contrato->id
        ],$checklist_array);

        if($checklist->estaCompleto()){
            // dd($contrato->presolicitud->perfil->prospecto->id);
            $integrante = Integrante::create([
                'prospecto_id' => $contrato->presolicitud->perfil->prospecto->id
            ]);
        }

        // dd($checklist->estaCompleto());

        return redirect()->route('contratos.checklist.index',['contrato'=>$contrato]);
        // dd($ficha_deposito_path );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChecklistFolder  $checklistFolder
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato, ChecklistFolder $checklist)
    {
        //
        $presolicitud = $contrato->presolicitud;
        $checklist = $contrato->checklist;
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.checklist',['presolicitud'=>$presolicitud,'contrato'=>$contrato,'checklist'=>$checklist]);
        // return $pdf->stream();
        return $pdf->download('contrato'.$contrato->numero_contrato.$presolicitud->nombre.$presolicitud->paterno.$presolicitud->materno."checklist.pdf");
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
        return "Check list -- Firma update";
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

    public function aprobarChecklist(Contrato $contrato, ChecklistFolder $checklist, $aprobado){
        if ($aprobado == 1) {
            $checklist->firmas = 1;
            $checklist->save();
        }
        else{
            $checklist->firmas = -1;
            $checklist->save();
        }
        return redirect()->back();
    }
}
