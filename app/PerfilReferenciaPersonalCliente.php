<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilReferenciaPersonalCliente extends Model
{
    //

    use SoftDeletes;

    protected $fillable=[
		'perfil_id',
    	'paterno',
		'materno',
		'nombre',
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
	public function perfil()
    {
    	return $this->belongsTo('App\PerfilDatosPersonalCliente','id','perfil_id');
    }
}
