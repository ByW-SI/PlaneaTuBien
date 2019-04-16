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
        'monto',
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
}
