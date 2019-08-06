<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPago extends Model
{
    protected $table = 'status_pagos';

    protected $fillable = [
    	'id',
    	'nombre'
	];

	protected $hidden=[
    	'created_at',
    	'uptated_at'
    ];
	
	//public function empleados(){
	//	return $this->hasMany('App\Empleados');
	//}
}
