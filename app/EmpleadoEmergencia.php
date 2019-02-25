<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoEmergencia extends Model
{
	use SoftDeletes;
    //
    protected $fillable=[
    	'sangre',
    	'enfermedades',
    	'alergias',
    	'operaciones',
    	'nombrecontact1',
    	'parentescocontac1',
    	'movilcontac2',
    	'nombrecontact2',
    	'parentescocontac2',
    	'movilcontac2',
    	'nombrecontact3',
    	'parentescocontac3',
    	'movilcontac3',
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
