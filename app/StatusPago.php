<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPago extends Model
{
    $table = 'status_pagos';

    protected $fillable = [
    	'id',
    	'nombre'
	];
	
	//public function empleados(){
	//	return $this->hasMany('App\Empleados');
	//}
}
