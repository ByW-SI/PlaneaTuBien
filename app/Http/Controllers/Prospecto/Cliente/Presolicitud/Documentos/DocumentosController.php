<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud\Documentos;

use App\Presolicitud;
use App\Prospecto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manualConsumidor(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.manual_pdf',['presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('manual_del_consumidor'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    }
    public function contrato(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.contrato_pdf',['presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('contrato'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    }

 
}
