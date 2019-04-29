<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud\Documentos;

use App\Presolicitud;
use App\Prospecto;
use App\Recibo;
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
    public function manualConsumidor(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo)
    {
        $plan = $presolicitud->cotizacion()->plan;
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.manual_pdf',['presolicitud'=>$presolicitud,'plan'=>$plan]);
        // return $pdf->stream();
        return $pdf->download('manual_del_consumidor'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno."contrato".$recibo->contrato->id.".pdf");
    }
    public function contrato(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo)
    {
        $recibos = $presolicitud->recibos;
        $plan = $presolicitud->cotizacion()->plan;
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.contrato_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibos'=>$recibos,'plan'=>$plan,'recibo'=>$recibo]);
        return $pdf->stream();
        // return $pdf->download('contrato'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    } 

    public function avisoPrivacidad(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.aviso_privacidad_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('aviso_Privacidad'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    }
    public function cartaBienvenida(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.carta_bienvenida_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('carta_de_bienvenida'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
    }
    public function consentimientoSeguro(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.consentimiento_seguro_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('consentimiento_seguro'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function cuestionarioCalidad(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.cuestionario_calidad_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        // return $pdf->stream();
        return $pdf->download('cuestionario_calidad'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function declaracionSalud(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.declaracion_salud_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'recibo'=>$recibo]);
        // return $pdf->stream();
        return $pdf->download('declaracion_salud'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function fichaDeposito(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $contrato = $recibo->contrato;
        $plan = $presolicitud->cotizacion()->plan;
        $corrida = $plan->cotizador($contrato->monto);
        // dd($presolicitud->cotizacion()->folio);
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.ficha_deposito_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'contrato'=>$contrato,'recibo'=>$recibo,'plan'=>$plan,'corrida'=>$corrida]);
        // return $pdf->stream();
        return $pdf->download('ficha_deposito'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function formatoDomicilio(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.domiciliacion_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud])->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('domiciliacion'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
    public function anexoTanda(Prospecto $prospecto, Presolicitud $presolicitud,Recibo $recibo){
        $cotizacion = $presolicitud->perfil->cotizacion;
        $plan = $cotizacion->plan;
        switch ($cotizacion->plan->nombre){
            case "Tanda 1":
                $puntos = 720;
                break;
            case "Tanda 2":
                $puntos = 720;
                break;
            case "Tanda 3":
                $puntos = 720;
                break;
            case "Tanda 6":
                $puntos = 720;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 12":
                $puntos = 630;
                break;
            case "Tanda 18":
                $puntos = 540;
                break;
            case "Tanda 24":
                $puntos = 630;
                break;
            case "Tanda 36":
                $puntos = 630;
                break;
        }

        $pdf = PDF::loadView('prospectos.presolicitud.documentos.anexo_tanda_pdf',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud,'plan'=>$plan,'recibo'=>$recibo,'cotizacion'=>$cotizacion,"puntos"=>$puntos]);
        return $pdf->stream();
        // return $pdf->download('anexo_tanda'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno.".pdf");
        
    }
 
}
