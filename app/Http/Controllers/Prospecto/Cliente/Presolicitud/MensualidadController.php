<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Presolicitud;
use App\Contrato;
use App\Mensualidad;
use App\Prospecto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MensualidadController extends Controller
{
    public function GenerarMensualidad(Prospecto $prospecto, Presolicitud $presolicitud,Contrato $contrato, Request $request)
    {
    	//Plan 
    	$plan = $presolicitud->cotizacion()->plan;
    	$cotizador=$plan->cotizador($contrato->monto);
    	$fecha = Carbon::parse($request->fecha);
        //dd(["corrida"=>$cotizador['corrida'],"monto"=>number_format($contrato->monto,2)]);
    	foreach ($cotizador['corrida'] as $key => $mes) {
    		$total_mes=0;
    		$total_mes=$mes['total'];
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
