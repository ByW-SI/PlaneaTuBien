<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conyuge extends Model
{
    //CÓNYUGE, CONCUBINO U  OBLIGADO SOLIDARIO 
    use SoftDeletes;

    protected $fillable=[
    	'paterno',
		'materno',
		'nombre',
		'fecha_nacimiento',
		'lugar_nacimiento',
		'nacionalidad',
		'tel_casa',
		'tel_oficina',
		'tel_celular',
		'email'
    ];

    protected $hidden=[
    	'presolicitud_id',
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
