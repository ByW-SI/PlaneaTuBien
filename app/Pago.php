<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
	protected $table = 'pagos';

	protected $fillable = [
		'id',
		'prospecto_id',
		'cotizacion_id',
		'status',
		'total',
		'monto',
		'restante',
		'identificacion',
		'comprobante',
		'forma',
		'banco',
		'cheque',
		'deposito',
		'tarjeta',
		'tarjetaHabiente',
		'referencia',
		'folio'
	];

	public function prospecto() {
		return $this->belongsTo('App\Prospecto');
	}

	public function cotizacion() {
		return $this->belongsTo('App\Cotizacion');
	}
}
