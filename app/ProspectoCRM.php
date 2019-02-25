<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProspectoCRM extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'fecha_act',
    	'fecha_contacto',
    	'fecha_aviso',
    	'hora_contacto',
    	'status',
    	'comentarios',
    	'acuerdos',
    	'observaciones',
    	'tipo_contacto'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function prospecto(){
    	return $this->belongsTo('App\Prospecto');
    }
}
