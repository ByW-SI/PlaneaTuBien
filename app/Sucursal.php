<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursals';

    protected $fillable = [
    	'id',
    	'nombre',
    	'abreviatura',
    	'responsable',
    	'descripcíon',
    	'calle',
    	'numext',
    	'numint',
        'colonia',
    	'cp',
    	'estado',
    	'delegacion',
    	'telefono',
	];
	
	public function empleados(){
		return $this->hasMany('App\Empleados');
	}
}
