<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'id',
        'tipo',
        'nombre',
        'paterno',
        'materno',
        'edad',
        'sexo',
        //'id_sucursal',
        'cargo',
        'id_jefe',
        'status',
        'fechabaja',
        'motivobaja'


    ];

    public function jefe(){
        return $this->belongsTo('App\Empleado', 'id_jefe');
    }

    public function empleados(){
        return $this->hasMany('App\Empleado', 'id_jefe', 'id');
    }
}
