<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoFaltaAdministrativa extends Model
{

	use SoftDeletes;
    //
    protected $fillable=[
    	'fecha',
    	'comentarios',
    	'problema',
    	'tipofalta',
    	'reporto'
    ];
    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=['deleted_at'];

    public function empleado(){
    	return $this->belongsTo('App\Empleado','empleado_id');
    }
}
