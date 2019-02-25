<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EmpleadoVacacion extends Model
{

	use SoftDeletes;
    //
    protected $fillable=[
    	'fecha_inicio',
    	'fecha_fin',
    	'dias_tomados',
    	'dias_restantes',
    	'periodo1',
    	'periodo2',
    	'dias_total',
    ];
    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=['deleted_at'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleado','empleado_id');
    }
}
