<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoPostal extends Model
{
    //
    protected $table="codigo_postal";
    protected $fillable=[
		'codigo_postal',
		'cestado',
		'poblacion',
		'municipio',
		'estado',
		'codigo_municipio',
		'ciudad'
    ];

    protected $hidden=['created_at','updated_at'];
}
