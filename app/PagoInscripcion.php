<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoInscripcion extends Model
{
	protected $table = 'pago_inscripcions';

	protected $fillable = [
		'id',
		'prospecto_id',
		'cotizacion_id',
		'status',
		'monto',
		'identificacion',
		'comprobante',
		'forma',
		'banco',
		'referencia',
		'folio'
	];

	public function prospecto() {
		return $this->belongsTo('App\Prospecto');
	}

	public function cotizacion() {
		return $this->belongsTo('App\Cotizacion');
	}
	public function recibos()
    {
    	return $this->hasMany('App\Recibo','pago_inscripcion_id','id');
    }
}