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
        'id_sucursal',
        'cargo',
        'id_jefe'


    ];

    public function contacto(){
        return $this->hasMany('App\EmpleadoContacto', 'id_contacto');
    }

    public function direccion(){
        return $this->hasMany('App\EmepladoDireccion');
    }

    public function sucursal(){
        return $this->belongsTo('App\Sucursal', 'id_sucursal');
    }

    public function jefe(){
        return $this->belongsTo('App\Empleado', 'id_jefe');
    }

    public function empleados(){
        return $this->hasMany('App\Empleado', 'id_jefe', 'id');
    }
}
