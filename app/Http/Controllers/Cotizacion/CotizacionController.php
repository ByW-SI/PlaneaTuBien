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
        $Cotizacion=$Presolicitud->perfil->cotizacion;
        $Plan=$Cotizacion->plan;
        //dd($Cotizacion);

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
        //$Dia_de_inicio=date($Dia_de_inicio->format('m'));

        if ($Plan->mes_1) {
            $aportacion1=$Plan->aportacion_1;
        }else{
            $aportacion1=0;
        }
        
        if ($Plan->mes_2) {
            $aportacion2=$Plan->aportacion_2;
        }else{
            $aportacion2=0;
        }
        if ($Plan->mes_3) {
            $aportacion3=$Plan->aportacion_3;
        }else{
            $aportacion3=0;
        }

        $Aportacion=$Monto_finaciar/$plazo;
        $Cuota_Admin_monto=$Monto_finaciar*($Cuota_Admin/100);
        $Seguro_vida_monto=$Monto_finaciar*($Seguro_vida/100);
        $Seguro_dano_monto=$Monto_finaciar*($Seguro_dano/100);
        $Total=$Aportacion+$Cuota_Admin_monto+$Seguro_vida_monto+$Seguro_dano_monto+($Cuota_Admin_monto*0.16);
        $corridaTabla=[];
        $PagoAcumuladoTotal=0;
        $PagoAcumulado=0;
        //dd($Dia_de_inicio);
        for ($i=0; $i < $plazo; $i++) { 
            
            if ($Dia_de_inicio->format('m') == "06" || $Dia_de_inicio->format('m') == "12") {
                $Aportacion=round($Aportacion*(($Factor_Actualizacion/100)+1),2);
                $Cuota_Admin_monto=round($Cuota_Admin_monto*(($Factor_Actualizacion/100)+1),2);
                $Seguro_vida_monto=round($Seguro_vida_monto*(($Factor_Actualizacion/100)+1),2);
                $Seguro_dano_monto=round($Seguro_dano_monto*(($Factor_Actualizacion/100)+1),2);
                $Total=$Aportacion+$Cuota_Admin_monto+$Seguro_vida_monto+$Seguro_dano_monto+($Cuota_Admin_monto*0.16);
                //dd($Factor_Actualizacion);
            }
            $PagoAcumuladoTotal+=$Total;
            if ($Plan->mes_1==($i+1)) {
                $Total=$Total+($Monto*($aportacion1/100));
            }
            if ($Plan->mes_2==($i+1)) {
                $Total=$Total+($Monto*($aportacion2/100));
            }
            if ($Plan->mes_3==($i+1)) {
                $Total=$Total+($Monto*($aportacion3/100));
            }
            if ( (date('m', strtotime($Dia_de_inicio)) == "12")&&(!is_null($Plan->anual))) {
                $Total=$Total+($Monto*($Plan->anual/100));
            }

            $PagoAcumulado+=$Total;
            array_push($corrida,
                        array(
                              'mes'=>$i+1,
                              'Aportacion' => $Aportacion , 
                              'Cuota'=> $Cuota_Admin_monto,
                              'Seguro_vida'=>$Seguro_vida_monto,
                              'Seguro_danos'=>$Seguro_dano_monto,
                              'Total'=>$Total
                        ));
            array_push ($corridaTabla,[ $i+1,round($Aportacion,2),round($Cuota_Admin_monto,2),round($Seguro_vida_monto,2),round($Seguro_dano_monto,2),round($Total,2),round($PagoAcumulado,2)]);
            $Dia_de_inicio->addMonths(1);

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
