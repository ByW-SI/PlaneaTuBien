<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    //
    protected $fillable=[
    	'nombre',
    	'plazo',
    	'mes_aportacion_adjudicado',
    	'mes_adjudicado',
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
        $monto_aportacion_anual = $monto_adjudicar*($this->semestral/100);
        return $monto_aportacion_anual;

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
        for ($i = 1; $i <= $this->plazo; $i++) {
            if(date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12")
            {
                $aportacion_mes = $aportacion_mes*1.03;
                $cuota_admon_mes= $cuota_admon_mes*1.03;
                $cuota_admon_mes_iva = $cuota_admon_mes_iva*1.03;
                $seguro_vida_mes = $seguro_vida_mes*1.03;
            }
            // if($this->plan_meses+1<$i){
            if($this->plan_meses<$i){

                // $seguro_desempleo = $monto_adjudicar*($this->s_d/100);
                if(date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12")
                {
                    $seguro_desempleo = $seguro_desempleo*1.03;
                }
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
        for ($i = 0 ; $i <  $this->plan_meses; $i++) {
            // var_dump($i);
            $aportacion_integrante += $corrida[$i]['aportacion'];
            $cuota_periodica_integrante += $corrida[$i]['total'];
        }
        $aportacion_integrante = $aportacion_integrante/$this->plan_meses;
        $cuota_periodica_integrante = $cuota_periodica_integrante/$this->plan_meses;
        $aportacion_adjudicado = 0.00;
        $cuota_periodica_adjudicado = 0.00;
        // var_dump('adjudicado');
        for($i= $this->plan_meses; $i< $this->plazo;$i++){
            $aportacion_adjudicado += $corrida[$i]['aportacion'];
            $cuota_periodica_adjudicado += $corrida[$i]['total'];
            // var_dump($i);
        }
        // dd($this->plazo-$this->plan_meses);
        $aportacion_adjudicado = $aportacion_adjudicado/($this->plazo-$this->plan_meses);
        $cuota_periodica_adjudicado = $cuota_periodica_adjudicado/($this->plazo-$this->plan_meses);
        $total_aportaciones_en_extraordin= $monto_adjudicar*($aportaciones_extraordinarias/100);
        $total_aportacion = $total_aportacion_en_mensualidades+$total_aportaciones_en_extraordin;
        return [
            'aportaciones_extraordinarias'=>$aportaciones_extraordinarias,
            'monto_financiar'=>$monto_financiar,
            'anual_total'=>$anual_total,
            'monto_adjudicar'=>$monto_adjudicar,
            'aportacion_integrante'=>$aportacion_integrante,
            'aportacion_adjudicado'=>$aportacion_adjudicado,
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



    public function grupos()
    {
        return $this->belongsToMany('App\Grupo')->using('App\GrupoPlan');
    }
}
