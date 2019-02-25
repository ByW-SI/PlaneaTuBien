<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promocion extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'nombre',
    	'monto',
    	'tipo_monto',
        'tipo_promo',
    	'valido_inicio',
    	'valido_fin',
    	'descripcion'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];

    public function cotizaciones()
    {
    	return $this->hasMany('App\Cotizacion');
    }
}
