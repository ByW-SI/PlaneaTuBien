<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Presolicitud;
use App\Contrato;
use App\Mensualidad;
use App\Prospecto;
use App\Grupo;
use App\Plan;
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
        //dd($cotizador);

    	$fecha = Carbon::parse($request->fecha);
        //dd(["corrida"=>$cotizador['corrida'],"monto"=>number_format($contrato->monto,2)]);
    	$this->CargarTodasMensualidades($plan->abreviatura,$cotizador['corrida'],$plan->mes_adjudicado,$contrato,$request->fecha,$plan);
        $grupos = Grupo::get();
        return view('prospectos.presolicitud.contratos.index', ['prospecto' => $prospecto, 'presolicitud' => $presolicitud, 'grupos'=>$grupos]);
    }
    public function CargarTodasMensualidades($Abrebiatura,$Corrida,$Mes,Contrato $contrato,$fecha,Plan $Plan)
    {
        $Dia_de_inicio=Carbon::parse($fecha);
        $fechaFor=Carbon::parse($fecha);
        if ($Abrebiatura=="TA") {
            $Pagoinicial=0;
            $Pagosegundario=0;
            for ($i=0; $i <count($Corrida) ; $i++) { 
                if ($Mes<($i+1)) {
                    $Pagosegundario+=round($Corrida[$i]['total'],2);
                }else{
                    $Pagoinicial+=round($Corrida[$i]['total'],2);
                }
            }
            $Pagoinicial=round($Pagoinicial/$Mes,2);
            $Pagosegundario=round($Pagosegundario/(count($Corrida)-$Mes),2);
            //dd([$Pagoinicial,$Pagosegundario]);
            foreach ($Corrida as $key => $mes) {
                //fecha
                if($key!=0){
                    $fechaFor=Carbon::parse($fecha)->addMonths($key);
                }
                if ($Mes<($key+1)) {
                    $Mensualidad = new Mensualidad(
                        array(
                            'pagado' => 0, 
                            'contrato_id'=>$contrato->id ,
                            'adono'=> 0.00,
                            'cantidad'=> $Pagosegundario,
                            'fecha'=> $fechaFor->toDateString() ,  
                            'recargo'=>0,
                            'descripcion'=>"Mensualidad"
                        )
                    );
                    $Mensualidad->save();
                }else{
                    $Mensualidad = new Mensualidad(
                        array(
                            'pagado' => 0, 
                            'contrato_id'=>$contrato->id ,
                            'adono'=> 0.00,
                            'cantidad'=> $Pagoinicial,
                            'fecha'=> $fechaFor->toDateString() ,  
                            'recargo'=>0,
                            'descripcion'=>"Mensualidad"

                        )
                    );
                    $Mensualidad->save();
                }
                    
            }
        }else{
            foreach ($Corrida as $key => $mes) {
                $total_mes=0;
                $total_mes=round($mes['Total'],2);
                //fecha
                if($key!=0){
                    $fechaFor=Carbon::parse($fecha)->addMonths($key);
                }
                $Mensualidad = new Mensualidad(
                    array(
                        'pagado' => 0, 
                        'contrato_id'=>$contrato->id ,
                        'adono'=> 0.00,
                        'cantidad'=> $total_mes,
                        'fecha'=> $fechaFor->toDateString() ,  
                        'recargo'=>0,
                        'descripcion'=>"Mensualidad"

                    )
                );
                $Mensualidad->save();
            }
        }
        $Monto=$contrato->monto;
        $descripcion="";
        for ($i=1; $i <count($Corrida) ; $i++) { 
            //if($i!=1){
                $Dia_de_inicio=Carbon::parse($fecha)->addMonths($i+1);
            //}

            if ( $Dia_de_inicio->format('m') == "12") {
                $PagoExtra=$Monto*($Plan->anual/100);
                $descripcion=$descripcion."Año ";
            }else{
                $PagoExtra=0;
                $descripcion="";
            }

            if ($Plan->mes_1==($i)) {
                $PagoExtra+=$Monto*($Plan->aportacion_1/100);
                if ($descripcion=="") {
                    $descripcion=$descripcion."Apex";
                }else{
                    $descripcion=$descripcion." y Apex";
                }
                
            }
            if ($Plan->mes_2==($i)) {
                $PagoExtra+=$Monto*($Plan->aportacion_2/100);
                if ($descripcion=="") {
                    $descripcion=$descripcion."Apex";
                }else{
                    $descripcion=$descripcion." y Apex";
                }
            }
            if ($Plan->mes_3==($i)) {
                $PagoExtra+=$Monto*($Plan->aportacion_3/100);
                if ($descripcion=="") {
                    $descripcion=$descripcion."Apex";
                }else{
                    $descripcion=$descripcion." y Apex";
                }
            }
            if ($Plan->mes_liquidacion==($i)) {
                $PagoExtra+=$Monto*($Plan->aportacion_liquidacion/100);
                if ($descripcion=="") {
                    $descripcion=$descripcion."Apex";
                }else{
                    $descripcion=$descripcion." y Apex";
                }
            }

            if ($PagoExtra>0) {
                $Mes=Mensualidad::where("contrato_id",$contrato->id)->orderBy('fecha', 'asc')->get();
                $Mensualidad = new Mensualidad(
                    array(
                        'pagado' => 0, 
                        'contrato_id'=>$contrato->id,
                        'adono'=> 0.00,
                        'cantidad'=> $PagoExtra,
                        'fecha'=> $Mes[$i-1]->fecha,  
                        'recargo'=>0,
                        'descripcion'=>$descripcion
                    )
                );
                $Mensualidad->save();

                //$Mes=Mensualidad::where("contrato_id",$contrato->id)->orderBy('fecha', 'asc')->get();
                //$Mes[$i]->cantidad+=$PagoExtra;
                //$Mes[$i]->save();  
            }

            
            
        }
    }
}
