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
    public function Apex(Request $request)
    {
        $Contrato=Contrato::where("id",$request->input('id'))->first();
        //$Contrato=$Contrato[0];
        $Grupo=$Contrato->Grupo;
        $Presolicitud=$Contrato->presolicitud;
        $Cotizacion=$Presolicitud->perfil->cotizacion;
        $Plan=$Cotizacion->plan;        

        $Apex=[];
        if ($Plan->aportacion_1) {
            array_push ($Apex,[ "Apex 1",$Plan->aportacion_1,$Plan->mes_1,"No pagado"]);
        }else{
            array_push ($Apex,[ "Apex 1","N/A","N/A","N/A"]);
        }
        
        if ($Plan->aportacion_2) {
            array_push ($Apex,[ "Apex 2",$Plan->aportacion_3,$Plan->mes_2,"No pagado"]);
        }else{
            array_push ($Apex,[ "Apex 3","N/A","N/A","N/A"]);
        }
        if ($Plan->aportacion_3) {
            array_push ($Apex,[ "Apex 3",$Plan->aportacion_3,$Plan->mes_3,"No pagado"]);
        }else{
            array_push ($Apex,[ "Apex 3","N/A","N/A","N/A"]);
        }
        if ($Plan->aportacion_liquidacion) {
            array_push ($Apex,[ "Apex Liquidacion",$Plan->aportacion_liquidacion,$Plan->mes_liquidacion,"No pagado"]);
        }else{
            array_push ($Apex,[ "Apex 1","N/A","N/A","N/A"]);
        }
        return json_encode(['data'=> $Apex]);
    }
    public function Mensualidad(Request $request)
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
        if ($Plan->mes_liquidacion) {
            $aportacionFinal=$Plan->aportacion_liquidacion;
        }else{
            $aportacionFinal=0;
        }

        $Aportacion=$Monto_finaciar/$plazo;
        $Cuota_Admin_monto=$Monto_finaciar*($Cuota_Admin/100);
        $Seguro_vida_monto=$Monto*($Seguro_vida/100);
        $Seguro_dano_monto=$Monto*($Seguro_dano/100);
        $Total=$Aportacion+$Cuota_Admin_monto+$Seguro_vida_monto+$Seguro_dano_monto+($Cuota_Admin_monto*0.16);
        $corridaTabla=[];
        $PagoAcumuladoTotal=0;
        $PagoAcumulado=0;
        //dd($Dia_de_inicio);
        for ($i=0; $i < $plazo; $i++) { 
            
            if ($Dia_de_inicio->format('m') == "06" || $Dia_de_inicio->format('m') == "12") {
                $Aportacion=$Aportacion*(($Factor_Actualizacion/100)+1);
                $Cuota_Admin_monto=$Cuota_Admin_monto*(($Factor_Actualizacion/100)+1);
                $Seguro_vida_monto=$Seguro_vida_monto*(($Factor_Actualizacion/100)+1);
                $Seguro_dano_monto=$Seguro_dano_monto*(($Factor_Actualizacion/100)+1);
                $Total=$Aportacion+$Cuota_Admin_monto+$Seguro_vida_monto+$Seguro_dano_monto+($Cuota_Admin_monto*0.16);
                //dd($Factor_Actualizacion);
            }
            
            array_push($corrida,
                        array(
                              'mes'=>$i+1,
                              'Aportacion' => $Aportacion , 
                              'Cuota'=> $Cuota_Admin_monto,
                              'Seguro_vida'=>$Seguro_vida_monto,
                              'Seguro_danos'=>$Seguro_dano_monto,
                              'Total'=>$Total
                        ));
            $Dia_de_inicio->addMonths(1);
           

        }

        $Adjudicacion=$Plan->mes_adjudicado;
        $Pagoinicial=0;
        $Pagosegundario=0;
        for ($i=0; $i <$plazo ; $i++) { 
            if ($Adjudicacion<($i+1)) {
                $Pagoinicial+=$corrida[$i]['Total'];
            }else{
                $Pagosegundario+=$corrida[$i]['Total'];
            }
        }
        dd($Pagoinicial);
        $Pagoinicial=$Pagoinicial/$Adjudicacion;
        $Pagosegundario=$Pagosegundario/($plazo-$Adjudicacion);


        $Dia_de_inicio=Carbon::parse($Contrato->created_at);
        
        for ($i=0; $i <$plazo ; $i++) { 

            $PagoAcumuladoTotal+=$Total;
            if ( $Dia_de_inicio->format('m') == "12") {
                $PagoExtra=$Monto*($Plan->anual/100);
            }else{
                $PagoExtra=0;
            }

            if ($Plan->mes_1==($i+1)) {
                $PagoExtra+=$Monto*($aportacion1/100);
            }
            if ($Plan->mes_2==($i+1)) {
                $PagoExtra+=$Monto*($aportacion2/100);
            }
            if ($Plan->mes_3==($i+1)) {
                $PagoExtra+=$Monto*($aportacion3/100);
            }
            if ($Plan->mes_liquidacion==($i+1)) {
                $PagoExtra+=$Monto*($aportacionFinal/100);
            }

            if ($Adjudicacion<$i) {
                array_push ($corridaTabla,[ $i+1,$Dia_de_inicio->format('m'),$Pagoinicial,$PagoExtra,"No pagado"]);
            }else{
                array_push ($corridaTabla,[ $i+1,$Dia_de_inicio->format('m'),$Pagosegundario,$PagoExtra,"No pagado"]);
            }
            $Dia_de_inicio->addMonths(1);
            
        }

        
        
        return json_encode(['data'=> $corridaTabla]);
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


        $Aportacion=$Monto_finaciar/$plazo;
        $Cuota_Admin_monto=$Monto_finaciar*($Cuota_Admin/100);
        $Seguro_vida_monto=$Monto*($Seguro_vida/100);
        $Seguro_dano_monto=$Monto*($Seguro_dano/100);
        $Total=$Aportacion+$Cuota_Admin_monto+$Seguro_vida_monto+$Seguro_dano_monto+($Cuota_Admin_monto*0.16);
        $corridaTabla=[];
        $PagoAcumuladoTotal=0;
        $PagoAcumulado=0;
        //dd($Dia_de_inicio);
        for ($i=0; $i < $plazo; $i++) { 
            
            if ($Dia_de_inicio->format('m') == "06" || $Dia_de_inicio->format('m') == "12") {
                $Aportacion=$Aportacion*(($Factor_Actualizacion/100)+1);
                $Cuota_Admin_monto=$Cuota_Admin_monto*(($Factor_Actualizacion/100)+1);
                $Seguro_vida_monto=$Seguro_vida_monto*(($Factor_Actualizacion/100)+1);
                $Seguro_dano_monto=$Seguro_dano_monto*(($Factor_Actualizacion/100)+1);
                $Total=$Aportacion+$Cuota_Admin_monto+$Seguro_vida_monto+$Seguro_dano_monto+($Cuota_Admin_monto*0.16);
                //dd($Factor_Actualizacion);
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
            array_push ($corridaTabla,[ $i+1,$Dia_de_inicio->format('m'),round($Aportacion,2),round($Cuota_Admin_monto,2),round($Seguro_vida_monto,2),round($Seguro_dano_monto,2),round($Total,2),round($PagoAcumulado,2)]);
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
