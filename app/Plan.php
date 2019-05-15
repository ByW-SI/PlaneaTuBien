<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    //
    protected $fillable=[
    	'nombre',
        'abreviatura',
    	'plazo',
    	'mes_aportacion_adjudicado',
    	'mes_adjudicado',
        'mes_completo_adjudicado',
        'plan_meses',
        'actualizaciones',
    	'aportacion_1',
    	'mes_1',
    	'aportacion_2',
    	'mes_2',
    	'aportacion_3',
    	'mes_3',
    	'aportacion_liquidacion',
    	'mes_liquidacion',
    	'semestral',
    	'anual',
    	'inscripcion',
    	'cuota_admon',
    	's_v',
    	's_d'
    ];
    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];
    protected $dates=[
    	'deleted_at'
    ];

    // VARIABLES
    public function getAnualTotalAttribute()
    {
        $anual = $this->anual*10;
        return $anual;
    }
    public function getAporExtrAttribute()
    {
        $total = $this->aportacion_1+$this->aportacion_2+$this->aportacion_3+$this->aportacion_liquidacion+$this->anual_total;
        return $total;
    }

    // FUNCIONES ADJUNTAS PARA COTIZAR

    public function monto_financiar($monto)
    {
        $monto_financiar = $monto*(1-($this->apor_extr/100));
        return $monto_financiar;
    }

    public function monto_adjudicar($monto)
    {
        $monto_adjudicar = $monto*(pow(1.03,$this->actualizaciones));
        return $monto_adjudicar;
    }

    public function monto_aportacion_1($monto){
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_1 = $monto_adjudicar*($this->aportacion_1/100);
        return $monto_aportacion_1;

    }
    public function monto_aportacion_2($monto){
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_2 = $monto_adjudicar*($this->aportacion_2/100);
        return $monto_aportacion_2;

    }
    public function monto_aportacion_3($monto){
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_3 = $monto_adjudicar*($this->aportacion_3/100);
        return $monto_aportacion_3;

    }
    public function monto_aportacion_liquidacion($monto){
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_liquidacion = $monto_adjudicar*($this->aportacion_liquidacion/100);
        return $monto_aportacion_liquidacion;

    }
    public function monto_aportacion_anual($monto){
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_anual = $monto_adjudicar*($this->anual/100);
        return $monto_aportacion_anual;

    }
    public function monto_aportacion_semestral($monto){
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_semestral = $monto_adjudicar*($this->semestral/100);
        return $monto_aportacion_semestral;

    }
    public function monto_inscripcion_con_iva($monto){
        $monto_inscripcion = $monto*1.16*($this->inscripcion/100);
        return $monto_inscripcion;
    }

    // COTIZADOR

    public function cotizador($monto)
    {
        $anual_total = $this->anual_total;
        $aportaciones_extraordinarias = $this->apor_extr;
        $monto_financiar = $this->monto_financiar($monto);
        $monto_adjudicar = $this->monto_adjudicar($monto);
        // $mes_actual = date('2018-11-11');
        $mes_actual = date('2018-11-01');

        // dd($mes_actual);
        $aportacion_mes = $monto_financiar/$this->plazo;
        $cuota_admon_mes = $monto_financiar*($this->cuota_admon/100);
        $cuota_admon_mes_iva=$cuota_admon_mes*(16/100);
        $seguro_vida_mes = $monto*($this->s_v/100);
        $seguro_desempleo = $monto_adjudicar*($this->s_d/100);
        $corrida = [];
        // dd($seguro_desempleo);
        $total_aportacion_en_mensualidades= 0.00;
        $total_cuota_administracion=0.00;
        $bandera_s_d = false;
        $salto = false;
        for ($i = 1; $i <= $this->plazo; $i++) {
            if(date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12")
            {
                $aportacion_mes = $aportacion_mes*1.03;
                $cuota_admon_mes= $cuota_admon_mes*1.03;
                $cuota_admon_mes_iva = $cuota_admon_mes_iva*1.03;
                $seguro_vida_mes = $seguro_vida_mes*1.03;
            }
            // if($this->plan_meses+1<$i){
            if($this->mes_adjudicado-1<$i){

                // $seguro_desempleo = $monto_adjudicar*($this->s_d/100);
                // if($bandera_s_d && (date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12"))
                if (date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12") {
                    $seguro_desempleo = $seguro_desempleo*1.03;
                }
                // $bandera_s_d = true;
                $mes = [
                    'mes'=>date('m',strtotime($mes_actual)),
                    'aportacion'=>$aportacion_mes,
                    'cuota_administracion'=>$cuota_admon_mes,
                    'iva'=>$cuota_admon_mes_iva,
                    'sv'=>$seguro_vida_mes,
                    'sd'=>$seguro_desempleo,
                    'total'=>$aportacion_mes+$cuota_admon_mes+$cuota_admon_mes_iva+$seguro_vida_mes+$seguro_desempleo,
                ];
            }
            else{
                $mes = [
                    'mes'=>date('m',strtotime($mes_actual)),
                    'aportacion'=>$aportacion_mes,
                    'cuota_administracion'=>$cuota_admon_mes,
                    'iva'=>$cuota_admon_mes_iva,
                    'sv'=>$seguro_vida_mes,
                    'sd'=>0.00,
                    'total'=>$aportacion_mes+$cuota_admon_mes+$cuota_admon_mes_iva+$seguro_vida_mes+0.00,
                ];
            }
            array_push($corrida,$mes);
            $total_aportacion_en_mensualidades += $aportacion_mes;
            $total_cuota_administracion +=$cuota_admon_mes;
            $mes_actual = date('Y-m-d',strtotime("+1 month",strtotime($mes_actual)));
            
        }
        $aportacion_integrante= 0.00;
        $cuota_periodica_integrante = 0.00;
        $cuota_administracion_integrante = 0.00;
        $iva_integrante=0.00;
        $sv_integrante=0.00;
        $sd_integrante=0.00;
        for ($i = 0 ; $i <  $this->plan_meses; $i++) {
            // var_dump($i);
            $aportacion_integrante += $corrida[$i]['aportacion'];
            $cuota_administracion_integrante += $corrida[$i]['cuota_administracion'];
            $iva_integrante += $corrida[$i]['iva'];
            $sv_integrante += $corrida[$i]['sv'];
            $sd_integrante += $corrida[$i]['sd'];
            $cuota_periodica_integrante += $corrida[$i]['total'];
        }
        $aportacion_integrante = $aportacion_integrante/$this->plan_meses;
        $cuota_administracion_integrante = $cuota_administracion_integrante/$this->plan_meses;
        $iva_integrante = $iva_integrante/$this->plan_meses;
        $sv_integrante = $sv_integrante/$this->plan_meses;
        $sd_integrante = $sd_integrante/$this->plan_meses;
        $cuota_periodica_integrante = $cuota_periodica_integrante/$this->plan_meses;
        $aportacion_adjudicado = 0.00;
        $cuota_periodica_adjudicado = 0.00;
        $cuota_administracion_adjudicado = 0.00;
        $iva_adjudicado=0.00;
        $sv_adjudicado=0.00;
        $sd_adjudicado=0.00;
        // var_dump('adjudicado');
        for($i= $this->plan_meses; $i< $this->plazo;$i++){
            $aportacion_adjudicado += $corrida[$i]['aportacion'];
            $cuota_administracion_adjudicado += $corrida[$i]['cuota_administracion'];
            $iva_adjudicado += $corrida[$i]['iva'];
            $sv_adjudicado += $corrida[$i]['sv'];
            $sd_adjudicado += $corrida[$i]['sd'];
            $cuota_periodica_adjudicado += $corrida[$i]['total'];
            // var_dump($i);
        }
        // dd($cuota_periodica_adjudicado);
        $aportacion_adjudicado = $aportacion_adjudicado/($this->plazo-$this->plan_meses);
        $cuota_administracion_adjudicado=$cuota_administracion_adjudicado/($this->plazo-$this->plan_meses);
        $iva_adjudicado=$iva_adjudicado/($this->plazo-$this->plan_meses);
        $sv_adjudicado=$sv_adjudicado/($this->plazo-$this->plan_meses);
        $sd_adjudicado=$sd_adjudicado/($this->plazo-$this->plan_meses);
        $cuota_periodica_adjudicado = $cuota_periodica_adjudicado/($this->plazo-$this->plan_meses);
        $total_aportaciones_en_extraordin= $monto_adjudicar*($aportaciones_extraordinarias/100);
        $total_aportacion = $total_aportacion_en_mensualidades+$total_aportaciones_en_extraordin;
        return [
            'aportaciones_extraordinarias'=>$aportaciones_extraordinarias,
            'monto_financiar'=>$monto_financiar,
            'anual_total'=>$anual_total,
            'monto_adjudicar'=>$monto_adjudicar,
            // Integrantes
            'aportacion_integrante'=>$aportacion_integrante,
            'cuota_administracion_integrante'=>$cuota_administracion_integrante,
            'iva_integrante'=>$iva_integrante,
            'sv_integrante'=>$sv_integrante,
            'sd_integrante'=>$sd_integrante,
            // adjudicado
            'aportacion_adjudicado'=>$aportacion_adjudicado,
            'cuota_administracion_adjudicado'=>$cuota_administracion_adjudicado,
            'iva_adjudicado'=>$iva_adjudicado,
            'sv_adjudicado'=>$sv_adjudicado,
            'sd_adjudicado'=>$sd_adjudicado,

            'cuota_periodica_integrante'=>$cuota_periodica_integrante,
            'cuota_periodica_adjudicado'=>$cuota_periodica_adjudicado,
            'total_aportacion_en_mensualidades'=>$total_aportacion_en_mensualidades,
            'total_aportaciones_en_extraordin'=>$total_aportaciones_en_extraordin,
            'total_aportacion'=>$total_aportacion,
            'total_cuota_administracion'=>$total_cuota_administracion,
            'corrida'=>$corrida,
            'mes_actual'=>$mes_actual,
            'aportacion_mes'=>$aportacion_mes,
            'cuota_admon_mes'=>$cuota_admon_mes,
            'cuota_admon_mes_iva'=>$cuota_admon_mes_iva,
            'seguro_vida_mes'=>$seguro_vida_mes,
            'seguro_desempleo'=>$seguro_desempleo,
        ];
        
    }

    public function aportaciones_extraordinarias($monto)
    {
        return $this->cotizador($monto)['aportaciones_extraordinarias'];
    }
    public function anual_total($monto)
    {
        return $this->cotizador($monto)['anual_total'];
    }
    public function aportacion_integrante($monto)
    {
        return $this->cotizador($monto)['aportacion_integrante'];
    }
    public function aportacion_adjudicado($monto)
    {
        return $this->cotizador($monto)['aportacion_adjudicado'];
    }
    public function cuota_periodica_integrante($monto)
    {
        return $this->cotizador($monto)['cuota_periodica_integrante'];
    }
    public function cuota_periodica_adjudicado($monto)
    {
        return $this->cotizador($monto)['cuota_periodica_adjudicado'];
    }
    public function total_aportacion_en_mensualidades($monto)
    {
        return $this->cotizador($monto)['total_aportacion_en_mensualidades'];
    }
    
    public function total_aportaciones_en_extraordin($monto)
    {
        return $this->cotizador($monto)['total_aportaciones_en_extraordin'];
    }
    public function total_aportacion($monto)
    {
        return $this->cotizador($monto)['total_aportacion'];
    }
    public function total_cuota_administracion($monto)
    {
        return $this->cotizador($monto)['total_cuota_administracion'];
    }
    public function corrida($monto)
    {
        return $this->cotizador($monto)['corrida'];
    }
    public function aportacion_mes($monto)
    {
        return $this->cotizador($monto)['aportacion_mes'];
    }
    public function cuota_admon_mes($monto)
    {
        return $this->cotizador($monto)['cuota_admon_mes'];
    }
    public function cuota_admon_mes_iva($monto)
    {
        return $this->cotizador($monto)['cuota_admon_mes_iva'];
    }
    public function seguro_vida_mes($monto)
    {
        return $this->cotizador($monto)['seguro_vida_mes'];
    }
    public function seguro_desastres($monto)
    {
        return $this->cotizador($monto)['seguro_desastres'];
    }

    public function corrida_meses_fijos($monto){

        $corrida = [
            'integrante'=>[
                'meses'=>$this->plan_meses,
                'aportacion'=>$this->cotizador($monto)['aportacion_integrante'],
                'cuota_administracion'=>$this->cotizador($monto)['cuota_administracion_integrante'],
                'iva'=>$this->cotizador($monto)['iva_integrante'],
                'sv'=>$this->cotizador($monto)['sv_integrante'],
                'sd'=>$this->cotizador($monto)['sd_integrante'],
                'total'=>$this->cotizador($monto)['cuota_periodica_integrante'],

            ],
            'adjudicado'=>[
                'meses'=>$this->plazo-$this->plan_meses,
                'aportacion'=>$this->cotizador($monto)['aportacion_adjudicado'],
                'cuota_administracion'=>$this->cotizador($monto)['cuota_administracion_adjudicado'],
                'iva'=>$this->cotizador($monto)['iva_adjudicado'],
                'sv'=>$this->cotizador($monto)['sv_adjudicado'],
                'sd'=>$this->cotizador($monto)['sd_adjudicado'],
                'total'=>$this->cotizador($monto)['cuota_periodica_adjudicado'],
            ]
        ];
        return $corrida;

    }
    public function monto_cuota_periodica_integrante($monto)
    {
        $cuota_periodica_integrante = $this->cuota_periodica_integrante($monto);
        $meses_integrante = $this->mes_aportacion_adjudicado;
        $monto_cuota_periodica_integrante =  $cuota_periodica_integrante*$meses_integrante;
        return $monto_cuota_periodica_integrante;

    }

    public function monto_cuota_periodica_adjudicado($monto)
    {
        $cuota_periodica_adjudicado = $this->cuota_periodica_adjudicado($monto);
        $meses_adjudicado = $this->plazo - $this->mes_aportacion_adjudicado;
        $monto_cuota_periodica_adjudicado = $cuota_periodica_adjudicado*$meses_adjudicado;
        return $monto_cuota_periodica_adjudicado;

    }
    public function monto_derecho_adjudicacion($monto)
    {
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_derecho_adjudicacion = $monto_adjudicar*0.025*1.16;

        return $monto_derecho_adjudicacion;
    }

    public function monto_total_pagar($monto)
    {
        $monto_aportaciones_extraordinarias = $this->total_aportaciones_en_extraordin($monto);
        $monto_cuota_periodica_integrante = $this->monto_cuota_periodica_integrante($monto);
        $monto_cuota_periodica_adjudicado = $this->monto_cuota_periodica_adjudicado($monto);
        $monto_inscripcion_con_iva = $this->monto_inscripcion_con_iva($monto);
        $monto_derecho_adjudicacion = $this->monto_derecho_adjudicacion($monto);
        $monto_total_pagar = $monto_aportaciones_extraordinarias + $monto_cuota_periodica_integrante +$monto_cuota_periodica_adjudicado + $monto_inscripcion_con_iva + $monto_derecho_adjudicacion;
        return $monto_total_pagar;
    }

    public function sobrecosto($monto)
    {
        $monto_total_pagar = $this->monto_total_pagar($monto);
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $sobrecosto = round(($monto_total_pagar/$monto_adjudicar)-1,2)*100;
        return $sobrecosto;
    }
    public function sobrecosto_anual($monto)
    {
        $sobrecosto_anual = $this->sobrecosto($monto)/10;
        return $sobrecosto_anual;
    }
    



    public function grupos()
    {
        return $this->belongsToMany('App\Grupo')->using('App\GrupoPlan');
    }
    public function cotizaciones(){
        return $this->hasMany('App\Cotizacion','plan_id');
    }
}
