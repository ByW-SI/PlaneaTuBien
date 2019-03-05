<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilHistorialCrediticioCliente extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'tarjeta_debito',
		'tarjeta_credito',
		'numero_tarjeta_debito',
		'numero_tarjeta_credito',
		'td_bancomer',
		'tc_bancomer',
		'td_santander',
		'tc_santander',
		'td_hsbc',
		'tc_hsbc',
		'tc_amex',
		'td_scotiabank',
		'tc_scotiabank',
		'td_banamex',
		'tc_banamex',
		'td_banorte',
		'tc_banorte',
		'en_buro_credito',
		'buro_credito',
		'limite_credito',
		'destino_1',
		'tipo_destino_1',
		'monto_destino_1',
		'destino_2',
		'tipo_destino_2',
		'monto_destino_2',
		'destino_3',
		'tipo_destino_3',
		'monto_destino_3',
		'calificacion_credito',
		'descripcion_calificacion'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];
}
