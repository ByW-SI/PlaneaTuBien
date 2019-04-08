<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistFolder extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'presolicitud_id',
    	'ficha_deposito_path',
		'perfil_path',
		'presolicitud_path',
		'contrato_path',
		'hoja_aceptacion_path',
		'manual_consumidor_path',
		'calidad_path',
		'privacidad_path',
		'copia_ficha_deposito_path',
		'identificacion_path',
		'comprobante_domicilio_path',
		'croquis_ubicacion_path',
		'carta_bienvenida_path',
		'anexos_path'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];

    public function presolicitud(){
    	return $this->belongsTo('App\Presolicitud','id','presolicitud_id');
    }
}
