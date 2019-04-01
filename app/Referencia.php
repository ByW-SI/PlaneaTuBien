<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referencia extends Model
{
    //REFERENCIAS PERSONALES DE LA PRESOLICITUD
    use SoftDeletes;

    protected $fillable=[
    	'paterno',
		'materno',
		'nombre',
		'telefono',
		'parentesco'
    ];
    protected $hidden=[
    	'created_at',
    	'uptated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];

    public function presolicitud(){
    	return $this->belongsTo('App\Presolicitud','id','presolicitud_id');
    }
}
