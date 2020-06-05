<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Presolicitud;
use App\Plan;
use App\Contrato;
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
                    <a  id='nav-historial' class='nav-link submenu' >
                        Contrato N°".$Contrato->numero_contrato.":
                    </a>
                </li>";
        }
        $Html.="</ul>
        </div>";
        return $Html;
    }
}
