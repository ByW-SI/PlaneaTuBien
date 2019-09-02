<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    //
    protected $fillable=[
        'id',
    	'numero',
    	'fecha_inicio',
    	'fecha_fin',
    	'vigencia',
    	'contratos',
    ];

    protected $hidden =[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];
    protected $date=[
    	'deleted_at'
    ];

    public function plans(){
    	return $this->belongsToMany('App\Plan')->using('App\GrupoPlan');
    }

    public function contrato(){
        return $this->hasMany('App\Contrato');
    }
}
