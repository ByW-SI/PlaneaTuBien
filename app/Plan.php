<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FactorActualizacion;

class Plan extends Model
{

    protected $fillable = [
        'nombre',
        'abreviatura',
        'plazo',
        'tipo',
        'mes_aportacion_adjudicado',
        'mes_adjudicado',
        'mes_s_d',
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
        's_d',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $dates = [
        'deleted_at'
    ];

    // VARIABLES

    public function getFactorActualizacionAttribute()
    {
        // RETORNA EL ULTIMO PORCENTAJE DE FACTOR DE ACTUALIZACIÓN, SI NO EXISTE, RETORNA 3
        $factor = FactorActualizacion::where('autorizar', 1)->get()->last();
        if ($factor) {
            return (float) $factor->porcentaje;
        } else {
            return (float) 3;
        }
    }
    public function getAnualTotalAttribute()
    {
        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {
            $anual = $this->anual * 14;
        } else {
            $anual = $this->anual * 10;
        }
        return $anual;
    }
    public function getAporExtrAttribute()
    {
        $total = $this->aportacion_1 + $this->aportacion_2 + $this->aportacion_3 + $this->aportacion_liquidacion + $this->anual_total;
        return $total;
    }

    // FUNCIONES ADJUNTAS PARA COTIZAR

    public function monto_financiar($monto)
    {
        $monto_financiar = $monto * (1 - ($this->apor_extr / 100));
        return $monto_financiar;
    }

    public function monto_adjudicar($monto, $factor_actualizacion = null)
    {
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }
        $monto_adjudicar = $monto * (pow(1 + ($factor_actualizacion / 100), $this->actualizaciones));
        // dd($factor_actualizacion);
        return $monto_adjudicar;
    }
    public function monto_adjudicar_tc($monto)
    {
        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {
            return $this->corrida($monto)[59]['monto_adjudicar'];
        }
    }

    public function monto_aportacion_1($monto)
    {
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_1 = $monto_adjudicar * ($this->aportacion_1 / 100);
        return $monto_aportacion_1;
    }
    public function monto_aportacion_2($monto)
    {
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_2 = $monto_adjudicar * ($this->aportacion_2 / 100);
        return $monto_aportacion_2;
    }
    public function monto_aportacion_3($monto)
    {
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_3 = $monto_adjudicar * ($this->aportacion_3 / 100);
        return $monto_aportacion_3;
    }
    public function monto_aportacion_liquidacion($monto)
    {
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_liquidacion = $monto_adjudicar * ($this->aportacion_liquidacion / 100);
        return $monto_aportacion_liquidacion;
    }
    public function monto_aportacion_anual($monto)
    {
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_anual = $monto_adjudicar * ($this->anual / 100);
        return $monto_aportacion_anual;
    }
    public function monto_aportacion_semestral($monto)
    {
        $monto_adjudicar = $this->monto_adjudicar($monto);
        $monto_aportacion_semestral = $monto_adjudicar * ($this->semestral / 100);
        return $monto_aportacion_semestral;
    }
    public function monto_inscripcion_con_iva($monto)
    {
        $monto_inscripcion = $monto * 1.16 * ($this->inscripcion / 100);
        return $monto_inscripcion;
    }

    // COTIZADOR

    public function cotizador($monto, $factor_actualizacion = null)
    {

        $corrida = [];
        $total_aportacion_en_mensualidades = 0.00;
        $total_cuota_administracion = 0.00;
        $bandera_s_d = false;
        $salto = false;

        // FLOAT: OBTENEMOS FACTOR ACTUALIZACION
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }

        // FLOAT: ANUAL TOTAL, APORTACION EXTRAORDINARIA, FINANCIACION DE MONTO Y MONTO PARA ADJUDICACION
        $anual_total = $this->anual_total;
        $aportaciones_extraordinarias = $this->apor_extr;
        $monto_financiar = $this->monto_financiar($monto);
        $monto_adjudicar = $this->monto_adjudicar($monto, $factor_actualizacion);

        $mes_actual = date('y-m-d');


        // INT: APORTACION POR MES
        $aportacion_mes = 0;
        if ($this->plazo) {
            $aportacion_mes = $monto_financiar / $this->plazo;
        }

        // OBTENEMOS EL MONTO DE LA CUOTA Y SEGURO
        $cuota_admon_mes = $monto_financiar * ($this->cuota_admon / 100);
        $cuota_admon_mes_iva = $cuota_admon_mes * (16 / 100);
        $seguro_vida_mes = $monto * ($this->s_v / 100);
        $seguro_desempleo = $monto * ($this->s_d / 100);
        

        // SI ES TANDA CLASICA
        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {
            $monto_adjudicar_tc = (float) $monto;
            $monto_anual = $monto_adjudicar_tc * ($this->anual / 100);

            // POR CADA PLAZO SI EL MES ACTUAL ES LA MITAD DE AÑO O FIN DE AÑO ACTUALIZAMOS LA APORTACION, CUOTAS, SEGURO Y MONTOS
            for ($i = 1; $i <= $this->plazo; $i++) {
                if (date('m', strtotime($mes_actual)) == "06" || date('m', strtotime($mes_actual)) == "12") {
                    $aportacion_mes = $aportacion_mes * (1 + ($factor_actualizacion / 100));
                    $cuota_admon_mes = $cuota_admon_mes * (1 + ($factor_actualizacion / 100));
                    $cuota_admon_mes_iva = $cuota_admon_mes_iva * (1 + ($factor_actualizacion / 100));
                    $seguro_vida_mes = $seguro_vida_mes * (1 + ($factor_actualizacion / 100));
                    $monto_financiar = $monto_financiar * (1 + ($factor_actualizacion / 100));
                    $monto_adjudicar_tc = $monto_adjudicar_tc * (1 + ($factor_actualizacion / 100));
                    $monto_anual = $monto_anual * (1 + ($factor_actualizacion / 100));
                }
                // if($this->plan_meses+1<$i){
                // 00<1
                // 00<2
                if ($this->mes_s_d - 1 < $i) {

                    // $seguro_desempleo = $monto_adjudicar*($this->s_d/100);
                    // if($bandera_s_d && (date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12"))
                    if (date('m', strtotime($mes_actual)) == "06" || date('m', strtotime($mes_actual)) == "12") {
                        $seguro_desempleo = $seguro_desempleo * (1 + ($factor_actualizacion / 100));
                    }
                    // $bandera_s_d = true;
                    $mes = [
                        'mes' => date('m', strtotime($mes_actual)),
                        'aportacion' => $aportacion_mes,
                        'cuota_administracion' => $cuota_admon_mes,
                        'iva' => $cuota_admon_mes_iva,
                        'sv' => $seguro_vida_mes,
                        'sd' => $seguro_desempleo,
                        'total' => $aportacion_mes + $cuota_admon_mes + $cuota_admon_mes_iva + $seguro_vida_mes + $seguro_desempleo,
                        'monto_financiar' => $monto_financiar,
                        'monto_adjudicar' => $monto_adjudicar_tc,
                        'monto_anual' => $monto_anual
                    ];
                } else {
                    $mes = [
                        'mes' => date('m', strtotime($mes_actual)),
                        'aportacion' => $aportacion_mes,
                        'cuota_administracion' => $cuota_admon_mes,
                        'iva' => $cuota_admon_mes_iva,
                        'sv' => $seguro_vida_mes,
                        'sd' => 0.00,
                        'total' => $aportacion_mes + $cuota_admon_mes + $cuota_admon_mes_iva + $seguro_vida_mes + 0.00,
                        'monto_financiar' => $monto_financiar,
                        'monto_adjudicar' => $monto_adjudicar_tc,
                        'monto_anual' => $monto_anual
                    ];
                }
                array_push($corrida, $mes);
                $total_aportacion_en_mensualidades += $aportacion_mes;
                if ($i <= 120) {
                    $total_cuota_administracion += $cuota_admon_mes;
                }
                $mes_actual = date('Y-m-d', strtotime("+1 month", strtotime($mes_actual)));
            }
            $monto_financiar = $this->monto_financiar($monto);
            $monto_adjudicar = $monto;
        } else {
            $monto_anual = (float)$monto * ($this->anual / 100);
            for ($i = 1; $i <= $this->plazo; $i++) {
                if (date('m', strtotime($mes_actual)) == "06" || date('m', strtotime($mes_actual)) == "12") {
                    $aportacion_mes = $aportacion_mes * (1 + ($factor_actualizacion / 100));
                    $cuota_admon_mes = $cuota_admon_mes * (1 + ($factor_actualizacion / 100));
                    $cuota_admon_mes_iva = $cuota_admon_mes_iva * (1 + ($factor_actualizacion / 100));
                    $seguro_vida_mes = $seguro_vida_mes * (1 + ($factor_actualizacion / 100));
                    $monto_anual = $monto_anual * (1 + ($factor_actualizacion / 100));
                }
                // if($this->plan_meses+1<$i){
                //dd($this->mes_s_d);
                if ($this->mes_s_d - 2 < $i) {

                    // $seguro_desempleo = $monto_adjudicar*($this->s_d/100);
                    // if($bandera_s_d && (date('m',strtotime($mes_actual)) == "06" || date('m',strtotime($mes_actual)) == "12"))
                    if (date('m', strtotime($mes_actual)) == "06" || date('m', strtotime($mes_actual)) == "12") {
                        $seguro_desempleo = $seguro_desempleo * (1 + ($factor_actualizacion / 100));
                    }
                    // $bandera_s_d = true;
                    $mes = [
                        'mes' => date('m', strtotime($mes_actual)),
                        'aportacion' => $aportacion_mes,
                        'cuota_administracion' => $cuota_admon_mes,
                        'iva' => $cuota_admon_mes_iva,
                        'sv' => $seguro_vida_mes,
                        'sd' => $seguro_desempleo,
                        'total' => $aportacion_mes + $cuota_admon_mes + $cuota_admon_mes_iva + $seguro_vida_mes + $seguro_desempleo,
                        'monto_anual' => $monto_anual //monto de la anualidad
                    ];
                } else {
                    $mes = [
                        'mes' => date('m', strtotime($mes_actual)),
                        'aportacion' => $aportacion_mes,
                        'cuota_administracion' => $cuota_admon_mes,
                        'iva' => $cuota_admon_mes_iva,
                        'sv' => $seguro_vida_mes,
                        'sd' => 0.00,
                        'total' => $aportacion_mes + $cuota_admon_mes + $cuota_admon_mes_iva + $seguro_vida_mes + 0.00,
                        'monto_anual' => $monto_anual //monto de la anualidad
                    ];
                }
                array_push($corrida, $mes);
                $total_aportacion_en_mensualidades += $aportacion_mes;
                $total_cuota_administracion += $cuota_admon_mes;
                $mes_actual = date('Y-m-d', strtotime("+1 month", strtotime($mes_actual)));
            }
        }
        //dd($corrida);
        $aportacion_integrante = 0.00;
        $cuota_periodica_integrante = 0.00;
        $cuota_administracion_integrante = 0.00;
        $iva_integrante = 0.00;
        $sv_integrante = 0.00;
        $sd_integrante = 0.00;
        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {
            for ($i = 0; $i <  1; $i++) {
                // var_dump($i);
                $aportacion_integrante += $corrida[$i]['aportacion'];
                $cuota_administracion_integrante += $corrida[$i]['cuota_administracion'];
                $iva_integrante += $corrida[$i]['iva'];
                $sv_integrante += $corrida[$i]['sv'];
                $sd_integrante += $corrida[$i]['sd'];
                $cuota_periodica_integrante += $corrida[$i]['total'];
            }
        } else {
            for ($i = 0; $i <  $this->mes_s_d - 1; $i++) {
                // var_dump($i);
                $aportacion_integrante += $corrida[$i]['aportacion'];
                $cuota_administracion_integrante += $corrida[$i]['cuota_administracion'];
                $iva_integrante += $corrida[$i]['iva'];
                $sv_integrante += $corrida[$i]['sv'];
                $sd_integrante += $corrida[$i]['sd'];
                $cuota_periodica_integrante += $corrida[$i]['total'];
            }
            $aportacion_integrante = $aportacion_integrante / ($this->mes_s_d - 1);
            $cuota_administracion_integrante = $cuota_administracion_integrante / ($this->mes_s_d - 1);
            $iva_integrante = $iva_integrante / ($this->mes_s_d - 1);
            $sv_integrante = $sv_integrante / ($this->mes_s_d - 1);
            $sd_integrante = $sd_integrante / ($this->mes_s_d - 1);
            $cuota_periodica_integrante = $cuota_periodica_integrante / ($this->mes_s_d - 1);
        }

        $aportacion_adjudicado = 0.00;
        $cuota_periodica_adjudicado = 0.00;
        $cuota_administracion_adjudicado = 0.00;
        $iva_adjudicado = 0.00;
        $sv_adjudicado = 0.00;
        $sd_adjudicado = 0.00;
        // var_dump('adjudicado');

        if ($this->mes_s_d > 0) {
            for ($i =  $this->mes_s_d - 1; $i < $this->plazo; $i++) {
                $aportacion_adjudicado += $corrida[$i]['aportacion'];
                $cuota_administracion_adjudicado += $corrida[$i]['cuota_administracion'];
                $iva_adjudicado += $corrida[$i]['iva'];
                $sv_adjudicado += $corrida[$i]['sv'];
                $sd_adjudicado += $corrida[$i]['sd'];
                $cuota_periodica_adjudicado += $corrida[$i]['total'];
                // var_dump($i);
            }
        }

        $aportacion_adjudicado = $aportacion_adjudicado / ($this->plazo - ($this->mes_s_d - 1));
        $cuota_administracion_adjudicado = $cuota_administracion_adjudicado / ($this->plazo - ($this->mes_s_d - 1));
        $iva_adjudicado = $iva_adjudicado / ($this->plazo - ($this->mes_s_d - 1));
        $sv_adjudicado = $sv_adjudicado / ($this->plazo - ($this->mes_s_d - 1));
        $sd_adjudicado = $sd_adjudicado / ($this->plazo - ($this->mes_s_d - 1));
        $cuota_periodica_adjudicado = $cuota_periodica_adjudicado / ($this->plazo - ($this->mes_s_d - 1));
        $total_aportaciones_en_extraordin = $monto_adjudicar * ($aportaciones_extraordinarias / 100);
        $total_aportacion = $total_aportacion_en_mensualidades + $total_aportaciones_en_extraordin;

        
        return [
            'aportaciones_extraordinarias' => $aportaciones_extraordinarias,
            'monto_financiar' => $monto_financiar,
            'anual_total' => $anual_total,
            'monto_adjudicar' => $monto_adjudicar,
            // Integrantes
            'aportacion_integrante' => $aportacion_integrante,
            'cuota_administracion_integrante' => $cuota_administracion_integrante,
            'iva_integrante' => $iva_integrante,
            'sv_integrante' => $sv_integrante,
            'sd_integrante' => $sd_integrante,
            // adjudicado
            'aportacion_adjudicado' => $aportacion_adjudicado,
            'cuota_administracion_adjudicado' => $cuota_administracion_adjudicado,
            'iva_adjudicado' => $iva_adjudicado,
            'sv_adjudicado' => $sv_adjudicado,
            'sd_adjudicado' => $sd_adjudicado,

            'cuota_periodica_integrante' => $cuota_periodica_integrante,
            'cuota_periodica_adjudicado' => $cuota_periodica_adjudicado,
            'total_aportacion_en_mensualidades' => $total_aportacion_en_mensualidades,
            'total_aportaciones_en_extraordin' => $total_aportaciones_en_extraordin,
            'total_aportacion' => $total_aportacion,
            'total_cuota_administracion' => $total_cuota_administracion,
            'corrida' => $corrida,
            'mes_actual' => $mes_actual,
            'aportacion_mes' => $aportacion_mes,
            'cuota_admon_mes' => $cuota_admon_mes,
            'cuota_admon_mes_iva' => $cuota_admon_mes_iva,
            'seguro_vida_mes' => $seguro_vida_mes,
            'seguro_desempleo' => $seguro_desempleo,
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
    public function cuota_periodica_integrante($monto, $factor_actualizacion = null)
    {
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }
        return $this->cotizador($monto, $factor_actualizacion)['cuota_periodica_integrante'];
    }
    public function cuota_periodica_adjudicado($monto, $factor_actualizacion = null)
    {
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }
        return $this->cotizador($monto, $factor_actualizacion)['cuota_periodica_adjudicado'];
    }
    public function total_aportacion_en_mensualidades($monto)
    {
        return $this->cotizador($monto)['total_aportacion_en_mensualidades'];
    }

    public function total_aportaciones_en_extraordin($monto, $factor_actualizacion = null)
    {
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }
        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {
            if($this->abreviatura !== "TD")
                $monto_adjudicar_25 = $this->monto_adjudicar_tc($monto) * 0.25;
            else
                $monto_adjudicar_25 = 0.0;
            $monto_anualidades =
                $this->corrida($monto)[11]['monto_anual'] +
                $this->corrida($monto)[23]['monto_anual'] +
                $this->corrida($monto)[35]['monto_anual'] +
                $this->corrida($monto)[47]['monto_anual'] +
                $this->corrida($monto)[59]['monto_anual'] +
                $this->corrida($monto)[71]['monto_anual'] +
                $this->corrida($monto)[83]['monto_anual'] +
                $this->corrida($monto)[95]['monto_anual'] +
                $this->corrida($monto)[106]['monto_anual'] +
                $this->corrida($monto)[119]['monto_anual'] +
                $this->corrida($monto)[131]['monto_anual'] +
                $this->corrida($monto)[143]['monto_anual'] +
                $this->corrida($monto)[155]['monto_anual'] +
                $this->corrida($monto)[167]['monto_anual'];

            // dd($monto_anualidades);
            $total_aportaciones_en_extraordin = $monto_adjudicar_25 + $monto_anualidades;
            return $total_aportaciones_en_extraordin;
        } else {
            return $this->cotizador($monto, $factor_actualizacion)['total_aportaciones_en_extraordin'];
        }
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

    public function corrida_meses_fijos($monto, $factor_actualizacion = null)
    {

        // OBTENEMOS FACTOR DE ACTUALIZACION
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }

        $corrida = [
            'integrante' => [
                'meses' => $this->mes_s_d - 1,
                'aportacion' => $this->cotizador($monto, $factor_actualizacion)['aportacion_integrante'],
                'cuota_administracion' => $this->cotizador($monto, $factor_actualizacion)['cuota_administracion_integrante'],
                'iva' => $this->cotizador($monto, $factor_actualizacion)['iva_integrante'],
                'sv' => $this->cotizador($monto, $factor_actualizacion)['sv_integrante'],
                'sd' => $this->cotizador($monto, $factor_actualizacion)['sd_integrante'],
                'total' => $this->cotizador($monto, $factor_actualizacion)['cuota_periodica_integrante'],

            ],
            'adjudicado' => [
                'meses' => $this->plazo - ($this->mes_s_d - 1),
                'aportacion' => $this->cotizador($monto, $factor_actualizacion)['aportacion_adjudicado'],
                'cuota_administracion' => $this->cotizador($monto, $factor_actualizacion)['cuota_administracion_adjudicado'],
                'iva' => $this->cotizador($monto, $factor_actualizacion)['iva_adjudicado'],
                'sv' => $this->cotizador($monto, $factor_actualizacion)['sv_adjudicado'],
                'sd' => $this->cotizador($monto, $factor_actualizacion)['sd_adjudicado'],
                'total' => $this->cotizador($monto, $factor_actualizacion)['cuota_periodica_adjudicado'],
            ]
        ];
        return $corrida;
    }
    public function monto_cuota_periodica_integrante($monto, $factor_actualizacion = null)
    {

        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {
            $corrida = $this->corrida($monto);
            $monto_cuota_periodica_integrante =  0;
            foreach ($corrida as $value) {
                $monto_cuota_periodica_integrante += $value['total'];
            }
            return $monto_cuota_periodica_integrante;
        } else {
            if ($factor_actualizacion == null) {
                $factor_actualizacion = (float) $this->factor_actualizacion;
            }
            $cuota_periodica_integrante = $this->cuota_periodica_integrante($monto, $factor_actualizacion);
            $meses_integrante = $this->mes_aportacion_adjudicado;
            $monto_cuota_periodica_integrante =  $cuota_periodica_integrante * $meses_integrante;
            return $monto_cuota_periodica_integrante;
        }
    }

    public function monto_cuota_periodica_adjudicado($monto, $factor_actualizacion = null)
    {
        // OBTENEMOS EL FACTOR DE ACTUALIZACION
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }

        // OBTENEMOS MONTO TOTAL DE LAS CUOTA PERIODICA DEL ADJUDICADO
        $cuota_periodica_adjudicado = $this->cuota_periodica_adjudicado($monto, $factor_actualizacion);
        $meses_adjudicado = $this->plazo - $this->mes_aportacion_adjudicado;
        $monto_cuota_periodica_adjudicado = $cuota_periodica_adjudicado * $meses_adjudicado;
        return $monto_cuota_periodica_adjudicado;
    }
    public function monto_derecho_adjudicacion($monto, $factor_actualizacion = null)
    {

        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {
            $monto_adjudicar = $this->monto_adjudicar_tc($monto);
            $monto_derecho_adjudicacion = $monto_adjudicar * 0.025 * 1.16;
        } else {
            if ($factor_actualizacion == null) {
                $factor_actualizacion = (float) $this->factor_actualizacion;
            }

            $monto_adjudicar = $this->monto_adjudicar($monto, $factor_actualizacion);
            $monto_derecho_adjudicacion = $monto_adjudicar * 0.025 * 1.16;
        }

        return $monto_derecho_adjudicacion;
    }

    public function monto_total_pagar($monto, $factor_actualizacion = null)
    {
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }
        $monto_aportaciones_extraordinarias = $this->total_aportaciones_en_extraordin($monto,$factor_actualizacion);
        $monto_cuota_periodica_integrante = $this->monto_cuota_periodica_integrante($monto,$factor_actualizacion);

        if ($this->abreviatura !== "TC" && $this->abreviatura !== "TD")
            $monto_cuota_periodica_adjudicado = $this->monto_cuota_periodica_adjudicado($monto,$factor_actualizacion);
        else
            $monto_cuota_periodica_adjudicado = 0.0;

        // dd($monto_aportaciones_extraordinarias);
        $monto_inscripcion_con_iva = $this->monto_inscripcion_con_iva($monto);
        if($this->abreviatura !== "TC" && $this->abreviatura !== "TD")
            $monto_derecho_adjudicacion = $this->monto_derecho_adjudicacion($monto, $factor_actualizacion);
        else
            $monto_derecho_adjudicacion = 0.0;
        $monto_total_pagar = $monto_aportaciones_extraordinarias + $monto_cuota_periodica_integrante + $monto_cuota_periodica_adjudicado + $monto_inscripcion_con_iva + $monto_derecho_adjudicacion;
        return $monto_total_pagar;
    }

    public function sobrecosto($monto, $factor_actualizacion = null)
    {

        if ($this->abreviatura == "TC" || $this->abreviatura == "TD") {

            $monto_total_pagar = $this->monto_total_pagar($monto);
            $monto_adjudicar = $this->monto_adjudicar_tc($monto);
        } else {
            if ($factor_actualizacion == null) {
                $factor_actualizacion = (float) $this->factor_actualizacion;
            }
            $monto_total_pagar = $this->monto_total_pagar($monto, $factor_actualizacion);
            $monto_adjudicar = $this->monto_adjudicar($monto, $factor_actualizacion);
        }
        $sobrecosto = round(($monto_total_pagar / $monto_adjudicar) - 1, 2) * 100;
        return $sobrecosto;
    }

    public function sobrecosto_anual($monto, $factor_actualizacion = null)
    {
        if ($factor_actualizacion == null) {
            $factor_actualizacion = (float) $this->factor_actualizacion;
        }
        $sobrecosto_anual = $this->sobrecosto($monto, $factor_actualizacion) / 10;
        return $sobrecosto_anual;
    }

    /**
     * Funciones usados para el plan libre y obtener la tabla de pagos minimos
     */
    public function getMontoscontratos($monto){
        $contratos = [];
        // SI LOS CONTRATOS SON MENORES O IGUALES A 550000 YA QUE NO HAY MULTIPLOS DE 300-500
        if ($monto == 550000) {
            array_push($contratos,550000);
            return $contratos;
        }
        else{
            $contratos_300 = $monto/300000;
            $residuo = $monto%300000;
            for ($i = 0; $i < (int)$contratos_300; $i++) {
                array_push($contratos,300000);
            }
            $contratos_mascincuentamil = $residuo/50000;
            $array = $this->residuo($contratos,$residuo);
        }
        // dd($contratos);
        return $array;

    }

    protected function residuo($array,$residuo)
    {
        $contratos_mascincuentamil = $residuo/50000;
        // dd($contratos_mascincuentamil);
        for ($i = 0; $i <sizeof($array);$i++) {
            if($contratos_mascincuentamil != 0){
                $array[$i] += 50000;
                $contratos_mascincuentamil -= 1;
            }
        }
        if($contratos_mascincuentamil == 0){
            return $array;
        }
        else{
            $residuo = $contratos_mascincuentamil*50000;
            return $this->residuo($array,$residuo);
        }
    }

   
    // RELACIONES


    public function grupos()
    {
        return $this->belongsToMany('App\Grupo')->using('App\GrupoPlan');
    }
    public function cotizaciones()
    {
        return $this->hasMany('App\Cotizacion', 'plan_id');
    }
}
