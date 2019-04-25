<?php

namespace App;

use App\Mail\CotizacionEnviada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Cotizacion extends Model
{
    use SoftDeletes;
    
    protected $table = 'cotizacions';

    // protected $fillable = [
    // 	'id',
    // 	'prospecto_id',
    // 	'propiedad',
    // 	'ahorro',
    //     'plan',
    //     'adjudicar',
    //     'plazo',
    //     'mensualidad',
    //     'porc1',
    //     'porc2',
    //     'porc3',
    //     'porc4',
    //     'monto1',
    //     'monto2',
    //     'monto3',
    //     'monto4',
    //     'mes1',
    //     'mes2',
    //     'mes3',
    //     'total',
    //     'anual',
    //     'inscripcion',
    // ];
    protected $fillable = [
        'folio',
        'monto',
        'elegir',
        'ahorro'
    ];

    protected $hidden =[
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $dates=[
        'deleted_at'
    ];

    public function prospecto() {
        return $this->belongsTo('App\Prospecto');
    }

    public function pagos() {
        return $this->hasMany('App\Pago');
    }

    public function plan()
    {
        return $this->belongsTo('App\Plan','plan_id','id');
    }

    public function promocion(){
        return $this->belongsTo('App\Promocion');
    }
    public function enviarCotizacion($email,$pdf)
    {
        $cotizacion = $this;
        // dd($email);
        Mail::to($email)->send(new CotizacionEnviada($cotizacion,$pdf));
    }

     public function task_send_mail()
    {
        return $this->hasOne('App\TaskSendMail','cotizacion_id','id');
    }
    public function inscripcionFaltante(){
        $pagos = $this->pagos;
        $total_pagos = 0.00;
        foreach ($pagos as $pago) {
            if($pago->status == "aprobado"){
                $total_pagos += $pago->total;
            }
        }
        $inscripcion = $this->plan->monto_inscripcion_con_iva($this->monto);
        $resta= $inscripcion - $total_pagos;
        return $resta;
    }


    public function contratos(){
        $monto = $this->monto;
        $contratos = [];
        // SI LOS CONTRATOS SON MENORES O IGUALES A 550000 YA QUE NO HAY MULTIPLOS DE 300-500
        if ($monto <= 550000) {
            array_push($contratos,550000);
        }
        else{
            $contratos_300 = $monto/300000;
            $residuo = $monto%300000;
            for ($i = 0; $i < 7; $i++) {
                array_push($contratos,300000);
            }
            $contratos_mascincuentamil = $residuo/50000;
            if($residuo%50000 == 0){
                if($contratos_mascincuentamil <=$contratos_300){
                    for ($i = 0; $i < $contratos_mascincuentamil; $i++) {
                        $contratos[$i] += 50000;
                    }
                }
            }

        }
        $total = 0;
        foreach ($contratos as $value) {
            $total += $value;
        }
        if($total == $monto){
            return $contratos;

        }
        else{
            dd("verifica tu metodo, tu total de contratos son ".$total." y tu monto es ".$monto);
        }

    }
}
