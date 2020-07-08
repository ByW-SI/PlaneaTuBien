<?php

namespace App\Http\Controllers\Cotizacion;

use App\Cotizacion;
use App\Contrato;
use App\Grupo;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CotizacionController extends Controller
{
    public function updatePlan(Request $request, Cotizacion $cotizacion){
        // dd($cotizacion);
        // dd($request->input());

        // return $cotizacion->perfil->presolicitud;

        $cotizacion->update([
            'plan_id' => $request->input('plan_id')
        ]);
        // $cotizacion->save();
        // dd($cotizacion);
        return redirect()->back();
    }
    public function Cotizacion(Request $request)
    {
        $corrida = [];

        $Contrato=Contrato::where("id",$request->input('contrato'))->get();
        $Contrato=$Contrato[0];
        $Grupo=$Contrato->Grupo;
        $Presolicitud=$Contrato->presolicitud;
        $Cotizacion=$Presolicitud->cotizacion;
        $Plan=$Cotizacion->plan;


        $Monto=$Contrato->monto;
        if ($this->SumatoriaAportaciones($Plan)>0) {
            $Monto_finaciar=$Monto-($Monto*($this->SumatoriaAportaciones($Plan)/100));
        }else{
            $Monto_finaciar=$Monto;
        }
        $plazo=$Plan->plazo;
        $Factor_Actualizacion=$Plan->getFactorActualizacionAttribute();
        $Cuota_Admin=$Plan->cuota_admon;
        $Seguro_vida=$Plan->s_v;
        $Seguro_dano=$Plan->s_d;


        $Dia_de_inicio=Carbon::parse($Contrato->created_at);

        //$Aportacion=[];
        //$Cuota=[];
        //$Seguro_vida=[];
        //$Seguro_danos=[];
        //$monto_mes=[];
        $Aportacion=$Monto_finaciar/$plazo;
        $Cuota_Admin_monto=$Monto_finaciar*($Cuota_Admin/100);
        $Seguro_vida_monto=$Monto_finaciar*($Seguro_vida/100);
        $Seguro_dano_monto=$Monto_finaciar*($Seguro_dano/100);
        $corridaTabla=[];
        for ($i=0; $i < $plazo; $i++) { 
            if (date('m', strtotime($Dia_de_inicio->format('Y-M-d'))) == "06" || date('m', strtotime($Dia_de_inicio->format('Y-M-d'))) == "12") {
                $Aportacion=$Aportacion*(($Factor_Actualizacion/100)+1);
                $Cuota_Admin_monto=$Cuota_Admin_monto*(($Factor_Actualizacion/100)+1);
                $Seguro_vida_monto=$Seguro_vida_monto*(($Factor_Actualizacion/100)+1);
                $Seguro_dano_monto=$Seguro_dano_monto*(($Factor_Actualizacion/100)+1);
            }
            array_push($corrida,
                        array('Aportacion' => $Aportacion , 
                              'Cuota'=> $Cuota_Admin_monto,
                              'Seguro_vida'=>$Seguro_vida_monto,
                              'Seguro_danos'=>$Seguro_dano_monto
                        ));
            array_push ($corridaTabla,[ $Aportacion,$Cuota_Admin_monto,$Seguro_vida_monto,$Seguro_dano_monto]);
        }

        
        
        return json_encode(['data'=> $corridaTabla]);

    }
    public function SumatoriaAportaciones(Plan $plan)
    {
        $plazo=$plan->plazo;
        if ($plan->aportacion_1) {
            $aportacion1=$plan->aportacion_1;
        }else{
            $aportacion1=0;
        }
        
        if ($plan->aportacion_2) {
            $aportacion2=$plan->aportacion_2;
        }else{
            $aportacion2=0;
        }
        if ($plan->aportacion_3) {
            $aportacion3=$plan->aportacion_3;
        }else{
            $aportacion3=0;
        }
        if ($plan->anual) {
            $aportacionAnual=$plan->anual;
        }else{
            $aportacionAnual=0;
        }
        if ($plan->aportacion_liquidacion) {
            $aportacionFinal=$plan->aportacion_liquidacion;
        }else{
            $aportacionFinal=0;
        }
        $ayos=$plazo/12;
        return($aportacion1+$aportacion2+$aportacion3+$aportacionFinal+($ayos*$aportacionAnual));
    }
}
