<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';

	protected $fillable = [
		'id',
		'contrato_id',
		'status',
		'monto',
		'fecha_pago',
		'adeudo',
		'total',
		'folio',
		'status_id',
		'tipopago_id',
		'tipocarga_id',
		'empleado_id',
		'referencia'
	];

	protected $hidden =[
    	'created_at',
    	'updated_at',
    ];

	public function contrato() {
		return $this->belongsTo('App\Contrato');
	}
}
