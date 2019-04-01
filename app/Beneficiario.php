<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiario extends Model
{
    //BENEFICIARIOS DEL PROSPECTOS
    use SoftDeletes;

    protected $fillable=[
    	'paterno',
		'materno',
		'nombre',
		'edad',
		'parentesco',
		'porcentaje'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at',
    ];

    protected $dates=[
    	'deleted_at'
    ];

   	public function presolicitud(){
    	return $this->belongsTo('App\Presolicitud','id','presolicitud_id');
    }
}
