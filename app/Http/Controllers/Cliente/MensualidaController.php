<?php

namespace App\Http\Controllers\Cliente;

use App\Presolicitud;
use App\Contrato;
use App\Mensualidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MensualidaController extends Controller
{
    public function GenerarMensualidad(Presolicitud $presolicitud,Contrato $contrato, Request $request)
    {
    	//Plan 
    	$plan = $presolicitud->cotizacion()->plan;
    	$cotizador=$plan->cotizador($contrato->monto);
    	$fecha = Carbon::parse($request->fecha);

    	foreach ($cotizador->corrida as $key => $mes) {
    		$total_mes=0;
    		$total_mes=$mes->total;
    		//fecha
    		if($key!=0){
    			$fecha=Carbon::now()->addMonths($key);
    		}
    		$Mensualidad = new Mensualidad(
    			array(
    				'pagado' => 0, 
    				'contrato_id'=>$contrato->id ,
    				'adono'=> 0.00,
    				'cantidad'=> $total_mes,
    				'fecha'=> $fecha->toDateString() ,  
    				'recargo'=>0,
    			)
    		);
    		$Mensualidad->save();
    	}
    }
}
