<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Presolicitud;
use App\Plan;
use App\Contrato;
use Carbon\Carbon;
use App\Referencia;
use App\Mensualidad;
use App\Gestion;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    //
    public function index()
    {
    	$prospectos = Auth::user()->empleado->prospectosActuales()->has('perfil')->has('cotizaciones')->get();
        $presolicitudes = Presolicitud::whereHas('perfil', function ($query) use ($prospectos) {
            return $query->has('cotizacion')->whereIn('prospecto_id', $prospectos->pluck('id')->flatten());
        })
        ->where('prospecto',1)
        ->get();

        $planes = Plan::get();
        return view('presolicitud_cliente.index', compact('prospectos', 'presolicitudes', 'planes'));
    	# code...
    }
    public function navegacion_contrato(Request $request)
    {
        $Contratos=Contrato::where('presolicitud_id',$request->input('id'))->get();
        $Html="<div id='navContrato2'>
        <ul class='nav nav-pills nav-fill'>";
        foreach ($Contratos as $Contrato) {
            
                $Html.="<li role='presentation' class='nav-item' 
                        onclick='Pestalla(".$Contrato->id.")'>
                    <a  id='n".$Contrato->id."' class='nav-link submenu SelectNav' >
                        Contrato N°".$Contrato->numero_contrato.":
                    </a>
                </li>";
        }
        $Html.="</ul>
        </div>";
        return $Html;
    }
    public function get_contrato(Request $request)
    {
        $Contrato=Contrato::where('id',$request->input('id'))->get();
        $Gestion=Gestion::where('contrato_id',$Contrato[0]->id)->orderBy('created_at', 'desc')->first();
        $Presolicitud=$Contrato[0]->presolicitud;
        $Cotizacion=$Presolicitud->perfil->cotizacion;
        $Plan=$Cotizacion->plan; 

        if ($Gestion!=null) {
            $jsonEn = array('Contrato' => $Contrato[0],'Presolicitud'=> $Contrato[0]->presolicitud,'Creacion'=>Carbon::parse($Contrato[0]->created_at)->format('d/m/Y'),'UltimaGSig'=>Carbon::parse($Gestion->fecha_sig)->format('d/m/Y'),'UltimaGfecha'=>Carbon::parse($Gestion->created_at)->format('d/m/Y'),'Puntos'=>$this->PuntosPlan(true,$Plan->mes_adjudicado,$Plan->plan_meses));
            return json_encode($jsonEn);
        }else{
            $jsonEn = array('Contrato' => $Contrato[0],'Presolicitud'=> $Contrato[0]->presolicitud,'Creacion'=>Carbon::parse($Contrato[0]->created_at)->format('d/m/Y'),'UltimaGSig'=>"--/--/--",'UltimaGfecha'=>"--/--/--",'Puntos'=>$this->PuntosPlan(true,$Plan->mes_adjudicado,$Plan->plan_meses));
            return json_encode($jsonEn);
        }
        
        # code...
    }
    public function get_prepagos(Request $request)
    {
        $Presolicituds=Presolicitud::where('id',$request->input('idP'))->get();
        $Contratos=Contrato::where('id',$request->input('idD'))->get();
        $Contrato=$Contratos[0];
        $Mensualidad=Mensualidad::where('contrato_id',$Contrato->id)->get();
        //dd($Mensualidad[0]->cantidad);
        $ajaxPagos=array();
        foreach ($Presolicituds as $Presolicitud) {
            $Referencias=Referencia::where('presolicitud_id',$Presolicitud->id)->get();
            array_push ($ajaxPagos,[ $Presolicitud->nombre,1,$Mensualidad[0]->cantidad,$Presolicitud->tel_casa,$Presolicitud->tel_oficina,$Presolicitud->tel_celular,$Referencias[0]->telefono,$Referencias[1]->telefono,$Referencias[2]->telefono]);
        }
        return json_encode(['data'=> $ajaxPagos]);

    }
    public function get_gestion(Request $request)
    {
        $Gestiones=Gestion::where('contrato_id',$request->input('id'))->get();

        $ajaxPagos=array();
        foreach ($Gestiones as $Gestion) {
            array_push ($ajaxPagos,[ $Gestion->gestion,Carbon::parse($Gestion->created_at)->format('d/m/Y'),$Gestion->comentario,Carbon::parse($Gestion->fecha_sig)->format('d/m/Y')]);
        }
        return json_encode(['data'=> $ajaxPagos]);
    }
    public function gestionStore(Request $request)
    {
        $Contrato=Contrato::where("id",$request->input('contrato_id'))->get();
        $Presolicitud=$Contrato[0]->presolicitud;

        
        $Gestion=Gestion::create([
            'contrato_id'=>$request->input('contrato_id'),
            'gestion'=>$request->input('gestion'),
            'fecha_sig'=>$request->input('fecha_sig'),
            'comentario'=>$request->input('comentario')
        ]);
        $Presolicitud->update(['gestion'=>$request->input('gestion'),'fecha_gestion'=>$Gestion->created_at]);
        $prospectos = Auth::user()->empleado->prospectosActuales()->has('perfil')->has('cotizaciones')->get();
        $presolicitudes = Presolicitud::whereHas('perfil', function ($query) use ($prospectos) {
            return $query->has('cotizacion')->whereIn('prospecto_id', $prospectos->pluck('id')->flatten());
        })
        ->where('prospecto',1)
        ->get();

        $planes = Plan::get();
        return view('presolicitud_cliente.index', compact('prospectos', 'presolicitudes', 'planes'));
        # code...
    }
    public function edicionDatosStore(Request $request)
    {
        $Presolicitud=Presolicitud::where('id',$request->input('id_Pre'))->get();
        $Presolicitud=$Presolicitud[0];
        $Presolicitud->update([ 'tel_casa'=>$request->input('tel_casa'),
                                'tel_oficina'=>$request->input('tel_oficina'),
                                'tel_celular'=>$request->input('tel_celular'),
                                'email'=>$request->input('email')
                            ]);
        $prospectos = Auth::user()->empleado->prospectosActuales()->has('perfil')->has('cotizaciones')->get();
        $presolicitudes = Presolicitud::whereHas('perfil', function ($query) use ($prospectos) {
            return $query->has('cotizacion')->whereIn('prospecto_id', $prospectos->pluck('id')->flatten());
        })
        ->where('prospecto',1)
        ->get();

        $planes = Plan::get();
        return view('presolicitud_cliente.index', compact('prospectos', 'presolicitudes', 'planes'));
        # code...
    }
    public function PuntosPlan($MesualidadFija,$Mes,$Plazo)
    {
        if ($MesualidadFija) {
            $Mespuntal=(1800-720)/($Plazo-$Mes);
            $MesinpuntualA=(1440-720)/($Plazo-$Mes);
            $MesinpuntualF=(1080-720)/($Plazo-$Mes);
            $Regalo=720-($Mespuntal*$Mes);
        }else{
            $Mespuntal=(1800-720)/($Plazo);
            $MesinpuntualA=(1440-720)/($Plazo);
            $MesinpuntualF=(1080-720)/($Plazo);
            $Regalo=0;
        }
        return array(
            'Mespuntal' => round ($Mespuntal,2), 
            'MesinpuntualA' => round ($MesinpuntualA,2),
            'MesinpuntualF' => round ($MesinpuntualF,2),
            'Regalo' => round ($Regalo,2),

        );
    }
}
