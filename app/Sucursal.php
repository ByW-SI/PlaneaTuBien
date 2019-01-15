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
    	'cp',
    	'estado',
    	'delegacion',
    	'telefono',
    ];
}
