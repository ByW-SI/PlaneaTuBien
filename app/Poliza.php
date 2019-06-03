<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    //

    protected $fillable = [
		'nombre',
		'descripcion',
		'fecha_inicio',
		'fecha_fin',
		'folio',
		'tel_contacto',
		'nombre_asesor',

    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];


}
