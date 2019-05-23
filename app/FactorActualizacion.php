<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactorActualizacion extends Model
{
    //

    protected $fillable=[
    	'porcentaje'
    ];

    protected $dates =[
    	'created_at',
    	'updated_at',
    ];


}
