<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoMensual extends Model
{
    protected $table = 'pago_mensuals';

	protected $fillable = [
		'id',
		'contrato_id',
		'status',
		'monto',
		'fecha_pago',
		'adeudo',
		'total',
		'folio'
	];

	protected $hidden =[
    	'created_at',
    	'updated_at',
    ];

	public function contrato() {
		return $this->belongsTo('App\Contrato');
	}
}
