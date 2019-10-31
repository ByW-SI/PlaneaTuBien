<?php

namespace App\Http\Controllers\Plan;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\CustomCotizacionExport;
use Maatwebsite\Excel\Facades\Excel;

class CotizadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res=null;
        $plan = null;
        // dd($request->plan);
        if($request->monto && $request->plan){
            $plan = Plan::find($request->plan);
            
            if ($plan->abreviatura !== "PL")
                $res=$plan->cotizador($request->monto);
            else {
                $res = $this->getCotizacionPlanLibre($request->monto, $plan);
            }
            // dd($res);
        }
        $planes = Plan::orderBy('nombre','asc')->get();
        // dd($res);
        return view('cotizador.index',['planes'=>$planes,'request'=>$request,'res'=>$res,'plan_select'=>$plan]);

    }

    public function calcular($monto,$plan_id,$descuento=0)
    {   
        $plan = Plan::find($plan_id);
        $plan->anual_total = $plan->anual_total;
        $plan->apor_extr = $plan->apor_extr;
        $plan->monto_financiar = number_format($plan->monto_financiar($monto),2);
        $plan->monto_adjudicar = number_format($plan->monto_adjudicar($monto),2);
        $plan->monto_aportacion_1 = number_format($plan->monto_aportacion_1($monto),2);
        $plan->monto_aportacion_2 = number_format($plan->monto_aportacion_2($monto),2);
        $plan->monto_aportacion_3 = number_format($plan->monto_aportacion_3($monto),2);
        $plan->monto_aportacion_liquidacion = number_format($plan->monto_aportacion_liquidacion($monto),2);
        $plan->monto_aportacion_anual = number_format($plan->monto_aportacion_anual($monto),2);
        $plan->monto_aportacion_semestral = number_format($plan->monto_aportacion_semestral($monto),2);
        $plan->mes_aportacion_adjudicado = $plan->mes_aportacion_adjudicado;
        $plan->cuota_periodica_integrante = number_format($plan->cotizador($monto)['cuota_periodica_integrante'],2);
        $plan->monto_total = number_format($plan->monto_total_pagar($monto),2);
        $plan->sobrecosto_anual = $plan->sobrecosto_anual($monto);
        $plan->monto_inscripcion_con_iva = number_format(($plan->monto_inscripcion_con_iva($monto)-($plan->monto_inscripcion_con_iva($monto)*($descuento/100))),2);
        return response()->json(['plan'=>$plan],200);
    }
    public function inscripcion($monto,$plan_id,$descuento=0){
        $plan = Plan::find($plan_id);
        $cuota_inscripcion = $monto*($plan->inscripcion/100)-($monto*($plan->inscripcion/100)*($descuento/100));
        $iva_inscripcion= $cuota_inscripcion*0.16;
        $aportacion_periodica = $monto/$plan->plazo;
        $cuota_administracion = $monto*($plan->cuota_admon/100);
        $iva_cuota_admon = $cuota_administracion*0.16;
        $seguro_vida = $monto*($plan->s_v/100);
        $primera_cuota_periodica_total = $aportacion_periodica+$cuota_administracion+$iva_cuota_admon+$seguro_vida;
        $suma_incripcion_y_cuota = $cuota_inscripcion+$iva_inscripcion+$primera_cuota_periodica_total;
        $recibo = [
            'inscripcion_inicial' => $cuota_inscripcion,
            'iva' => $iva_inscripcion,
            'monto_inscripcion_con_iva' => $cuota_inscripcion+$iva_inscripcion,
            'cuota_periodica' => $primera_cuota_periodica_total
        ];
        return response()->json(['recibo'=>$recibo],201);
    }

    public function getCotizacionPlanLibre($monto, $plan)
    {
        if(gettype($plan) == "string")
            $plan = Plan::find($plan);
        $res = $plan->getMontoscontratos($monto);
        $aux;
        foreach ($res as $monto) {
            switch ($monto) {
                case 300000:
                    $aux[] = ['minimo'=>1000,'posible1'=>2000,'posible2'=>3000,'posible3'=>4000,'maximo'=>5000];
                    break;
                case 350000:
                    $aux[] = ['minimo'=>2100,'posible1'=>3100,'posible2'=>4100,'posible3'=>5100,'maximo'=>5600];
                    break;
                case 400000:
                    $aux[] = ['minimo'=>2400,'posible1'=>3400,'posible2'=>4400,'posible3'=>5400,'maximo'=>6400];
                    break;
                case 450000:
                    $aux[] = ['minimo'=>2700,'posible1'=>3700,'posible2'=>4700,'posible3'=>5700,'maximo'=>7200];
                    break;
                case 500000:
                    $aux[] = ['minimo'=>3000,'posible1'=>4000,'posible2'=>5000,'posible3'=>6000,'maximo'=>8000];
                    break;
                case 550000:
                    $aux[] = ['minimo'=>3000,'posible1'=>4000,'posible2'=>5000,'posible3'=>6000,'maximo'=>8000];
                    break;
            }
        }
        $res = ['minimo'=>0,'posible1'=>0,'posible2'=>0,'posible3'=>0,'maximo'=>0];;
        foreach ($aux as $contrato) {
            $res['minimo'] += $contrato['minimo'];
            $res['posible1'] += $contrato['posible1'];
            $res['posible2'] += $contrato['posible2'];
            $res['posible3'] += $contrato['posible3'];
            $res['maximo'] += $contrato['maximo'];
        }
        return $res;
    }

    public function exportPDF(Request $request)
    {
        // dd($request->all());
        if($request->monto && $request->plan){
            $plan = Plan::find($request->plan);
            
            if ($plan->abreviatura !== "PL")
                $res=$plan->cotizador($request->monto);
            else {
                $res = $this->getCotizacionPlanLibre($request->monto, $plan);
            }
            // dd($res);
        }
        $pdf = PDF::loadView('cotizador.pdf', ['plan'=>$plan, 'monto'=>$request->monto, 'res'=>$res]);
        //return $pdf->stream();
        return $pdf->download('cotizacion'. date('d/m/Y-h-i-s'). ".pdf");
    }
    public function exportExcel(Request $request)
    {
        if($request->monto && $request->plan){
            $plan = Plan::find($request->plan);
            
            if ($plan->abreviatura !== "PL")
                $res=$plan->cotizador($request->monto);
            else {
                $res = $this->getCotizacionPlanLibre($request->monto, $plan);
            }
            // dd($res);
        }

        return Excel::download(new CustomCotizacionExport($plan, $request->monto, $res), 'cotizacion'.date('d-m-Y-h-i-s').'.xlsx');
    }
    // public function cotizar($monto,$plan){
        
    //     $anual_total = $plan->anual_total;
    //     $aportaciones_extraordinarias = $plan->apor_extr;
    //     $monto_financiar = $plan->monto_financiar($monto);
    //     $monto_adjudicar = $plan->monto_adjudicar($monto);
    //     $mes_actual = date('2018-11-11');
    //     // dd($mes_actual);
    //     $aportacion_mes = $monto_financiar/$plan->plazo;
    //     $cuota_admon_mes = $monto_financiar*($plan->cuota_admon/100);
    //     $cuota_admon_mes_iva=$cuota_admon_mes*(16/100);
    //     $seguro_vida_mes = $monto*($plan->s_v/100);
    //     $seguro_desempleo = $monto_adjudicar*($plan->s_d/100);
    //     $corrida = [];
    //     // dd($seguro_desempleo);
    //     $total_aportacion_en_mensualidades= 0.00;
    //     $total_cuota_administracion=0.00;
    //     for ($i = 1; $i <= $plan->plazo; $i++) {
    //         if(date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12")
    //         {
    //             $aportacion_mes = $aportacion_mes*1.03;
    //             $cuota_admon_mes= $cuota_admon_mes*1.03;
    //             $cuota_admon_mes_iva = $cuota_admon_mes_iva*1.03;
    //             $seguro_vida_mes = $seguro_vida_mes*1.03;
    //         }
    //         if($plan->plan_meses<$i){
    //             // $seguro_desempleo = $monto_adjudicar*($plan->s_d/100);
    //             if(date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12")
    //             {
    //                 $seguro_desempleo = $seguro_desempleo*1.03;
    //             }
    //             $mes = [
    //                 'mes'=>date('m',strtotime($mes_actual)),
    //                 'aportacion'=>$aportacion_mes,
    //                 'cuota_administracion'=>$cuota_admon_mes,
    //                 'iva'=>$cuota_admon_mes_iva,
    //                 'sv'=>$seguro_vida_mes,
    //                 'sd'=>$seguro_desempleo,
    //                 'total'=>$aportacion_mes+$cuota_admon_mes+$cuota_admon_mes_iva+$seguro_vida_mes+$seguro_desempleo,
    //             ];
    //         }
    //         else{
    //             $mes = [
    //                 'mes'=>date('m',strtotime($mes_actual)),
    //                 'aportacion'=>$aportacion_mes,
    //                 'cuota_administracion'=>$cuota_admon_mes,
    //                 'iva'=>$cuota_admon_mes_iva,
    //                 'sv'=>$seguro_vida_mes,
    //                 'sd'=>0.00,
    //                 'total'=>$aportacion_mes+$cuota_admon_mes+$cuota_admon_mes_iva+$seguro_vida_mes+0.00,
    //             ];
    //         }
    //         array_push($corrida,$mes);
    //         $total_aportacion_en_mensualidades += $aportacion_mes;
    //         $total_cuota_administracion +=$cuota_admon_mes;
    //         $mes_actual = date('Y-m-d',strtotime("+1 month",strtotime($mes_actual)));,
            
    //     }
    //     $aportacion_integrante= 0.00;
    //     $cuota_periodica_integrante = 0.00;
    //     for ($i = 0 ; $i <  $plan->plan_meses; $i++) {
    //         // var_dump($i);
    //         $aportacion_integrante += $corrida[$i]['aportacion'];
    //         $cuota_periodica_integrante += $corrida[$i]['total'];
    //     }
    //     $aportacion_integrante = $aportacion_integrante/$plan->plan_meses;
    //     $cuota_periodica_integrante = $cuota_periodica_integrante/$plan->plan_meses;
    //     $aportacion_adjudicado = 0.00;
    //     $cuota_periodica_adjudicado = 0.00;
    //     // var_dump('adjudicado');
    //     for($i= $plan->plan_meses; $i< $plan->plazo;$i++){
    //         $aportacion_adjudicado += $corrida[$i]['aportacion'];
    //         $cuota_periodica_adjudicado += $corrida[$i]['total'];
    //         // var_dump($i);
    //     }
    //     // dd($plan->plazo-$plan->plan_meses);
    //     $aportacion_adjudicado = $aportacion_adjudicado/($plan->plazo-$plan->plan_meses);
    //     $cuota_periodica_adjudicado = $cuota_periodica_adjudicado/($plan->plazo-$plan->plan_meses);
    //     $total_aportaciones_en_extraordin= $monto_adjudicar*($aportaciones_extraordinarias/100);
    //     $total_aportacion = $total_aportacion_en_mensualidades+$total_aportaciones_en_extraordin;
    //     dd($total_cuota_administracion);
    //     dd($aportacion_integrante." ".$aportacion_adjudicado);
    //     dd($corrida);

    // }

    
}
