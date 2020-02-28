<?php

namespace App;

use App\Mail\CotizacionEnviada;
use App\Mail\OrderShipped;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Cotizacion extends Model
{
    use SoftDeletes;
    
    protected $table = 'cotizacions';


    protected $fillable = [
        'plan_id',
        'folio',
        'monto',
        'elegir',
        'ahorro',
        'descuento',
        'inscripcion',
        'promocion_id',
        'factor_actualizacion',
        'tipo_inscripcion'
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

    public function pago_inscripcions() {
        return $this->hasMany('App\PagoInscripcion');
    }
    public function perfil() {
        return $this->hasOne('App\PerfilDatosPersonalCliente');
    }

    public function plan()
    {
        return $this->belongsTo('App\Plan','plan_id','id');
    }

    public function promocion(){
        return $this->belongsTo('App\Promocion');
    }

    public function datos_de_cotizacion()
    {
        return $this->belongsTo('App\Datos_de_Cotizacion');
    }

    public function corrida()
    {
        return $this->hasMany('App\Corrida');
    }

    public function enviarCotizacion($email,$pdf)
    {
        $cotizacion = $this;
        // dd($email);
        Mail::to($email)->send(new CotizacionEnviada($cotizacion,$pdf));
        //Mail::to($email)->send(new OrderShipped());
    }

    public function getInscripcionTotalAttribute()
    {
        $monto_inscripcion_con_iva = $this->plan->monto_inscripcion_con_iva($this->monto);
        $inscripcion_total = $monto_inscripcion_con_iva-($monto_inscripcion_con_iva*($this->descuento/100));
        return $inscripcion_total;
    }
    public function getCuotaPeriodicaTotalAttribute()
    {

        if( isset($this->plan->plazo) ){
            $aportacion_periodica = $this->monto/$this->plan->plazo;
        }else{
            $aportacion_periodica = 0;
        }

        
        $cuota_administracion = $this->monto*($this->plan->cuota_admon/100);
        $iva_cuota_admon = $cuota_administracion*0.16;
        $seguro_vida = $this->monto*($this->plan->s_v/100);
        $primera_cuota_periodica_total = $aportacion_periodica+$cuota_administracion+$iva_cuota_admon+$seguro_vida;
        return $primera_cuota_periodica_total;
    }

     public function task_send_mail()
    {
        return $this->hasOne('App\TaskSendMail','cotizacion_id','id');
    }
    public function inscripcionFaltante(){
        $pagos = $this->pago_inscripcions;
        $total_pagos = 0.00;
        foreach ($pagos as $pago) {
            if($pago->status == "aprobado"){
                $total_pagos += $pago->monto;
            }
        }
        $inscripcion = $this->inscripcion_total+$this->cuota_periodica_total;
        $resta= $inscripcion - $total_pagos;
        return $resta;
    }
    public function getTotalPagadoAttribute()
    {
        $pagos = $this->pago_inscripcions;
        $total_pagos = 0.00;
        foreach ($pagos as $pago) {
            if($pago->status == "aprobado"){
                $total_pagos += $pago->monto;
            }
        }
        return $total_pagos;
    }


    public function contratos(){
        $monto = $this->monto;
        $contratos = [];
        // SI LOS CONTRATOS SON MENORES O IGUALES A 550000 YA QUE NO HAY MULTIPLOS DE 300-500
        if ($monto == 550000) {
            array_push($contratos,550000);
        }
        else{
            $contratos_300 = $monto/300000;
            $residuo = $monto%300000;
            for ($i = 0; $i < (int)$contratos_300; $i++) {
                array_push($contratos,300000);
            }
            $contratos_mascincuentamil = $residuo/50000;
            $array = $this->residuo($contratos,$residuo);
            // dd($array);

            // if($residuo%50000 == 0){
            //     dd($residuo);
            //     if($contratos_mascincuentamil >= (int)$contratos_300){
            //         for ($i = 0; $i < $contratos_mascincuentamil; $i++) {
            //             $contratos[$i] += 50000;
            //         }
            //     }
            // }

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

    /**
     * ==========
     * ATTRIBUTES
     * ==========
     */

    public function getTotalPagadoDeInscripcionAttribute(){
        return $this->pago_inscripcions->pluck('monto')->flatten()->sum();
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

}
