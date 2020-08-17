<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Presolicitud;
use App\Contrato;
use App\Mensualidad;
use App\Prospecto;
use App\Grupo;
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
    	$this->TipoMensualidad($plan->abreviatura,$cotizador['corrida'],$plan->mes_adjudicado);
        $grupos = Grupo::get();
        return view('prospectos.presolicitud.contratos.index', ['prospecto' => $prospecto, 'presolicitud' => $presolicitud, 'grupos'=>$grupos]);
    }
    public function TipoMensualidad($Abrebiatura,$Corrida,$Mes)
    {
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
            dd([$Pagoinicial,$Pagosegundario]);
            foreach ($Corrida as $key => $mes) {
                //fecha
                if($key!=0){
                    $fecha=Carbon::now()->addMonths($key);
                }
                if ($Mes<($key+1)) {
                    $Mensualidad = new Mensualidad(
                        array(
                            'pagado' => 0, 
                            'contrato_id'=>$contrato->id ,
                            'adono'=> 0.00,
                            'cantidad'=> $Pagosegundario,
                            'fecha'=> $fecha->toDateString() ,  
                            'recargo'=>0,
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
                            'fecha'=> $fecha->toDateString() ,  
                            'recargo'=>0,
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
}
