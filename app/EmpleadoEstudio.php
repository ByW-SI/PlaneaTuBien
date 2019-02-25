<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoEstudio extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'escolaridad1',
    	'institucion1',
    	'cedula1',
    	'escolaridad2',
    	'institucion2',
    	'cedula2',
    	'idioma1',
    	'nivel1',
    	'idioma2',
    	'nivel2',
    	'idioma3',
    	'nivel3',
    	'curso1',
    	'certificado1',
    	'curso2',
    	'certificado2',
    	'curso3',
    	'certificado3'
    ];

    protected $hidden =[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];
    protected $dates=['deleted_at'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleado');
    }

}
