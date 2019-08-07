<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corrida extends Model
{
    protected $table = 'corridas';

    protected $fillable = [
    	'id',
    	'cotizacion_id',
	    'mes',
	    'aportacion',
	    'cuota_administracion',
	    'iva',
	    'seguro_vida',
	    'seguro_desastres',
	    'total'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function cotizacion()
    {
        return $this->belongsTo('App\Cotizacion');
    }
}
