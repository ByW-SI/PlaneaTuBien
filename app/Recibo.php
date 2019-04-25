<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    //
    protected $fillable=[
    	'sucursal',
		'tipo_pago',
		'tipo_tarjeta',
		'numero',
		'banco',
		'insc_inicial',
		'iva',
		'subtotal',
		'cuota_periodica',
		'total'
    ];
    protected $hidden=[
    	'created_at',
    	'uptated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];

    public function presolicitud(){
    	return $this->belongsTo('App\Presolicitud','id','presolicitud_id');
    }

    public function contrato()
    {
        return $this->hasOne('App\Contrato');
    }
}
