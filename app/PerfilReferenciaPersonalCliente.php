<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilReferenciaPersonalCliente extends Model
{
    //

    use SoftDeletes;

    protected $fillable=[
    	'nombre_completo',
		'parentesco',
		'telefono',
		'celular'
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
