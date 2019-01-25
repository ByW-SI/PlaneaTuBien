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
        'email',
        'edad',
        'sexo',
        'sucursal_id',
        'cargo',
        'id_jefe',
        'status',
        'fechabaja',
        'motivobaja'
    ];

    public function clientes() {
        return $this->hasOne('App\Cliente');
    }

    public function contactos(){
        return $this->hasMany('App\EmpleadoContacto');
    }

    public function direcciones(){
        return $this->hasMany('App\EmpleadoDireccion');
    }

    public function jefe(){
        return $this->belongsTo('App\Empleado', 'id_jefe');
    }

    public function empleados(){
        return $this->hasMany('App\Empleado', 'id_jefe', 'id');
    }

    public function sucursal(){
        return $this->belongsTo('App\Sucursal');
    }

    public function user() {
        return $this->hasOne('App\User');
    }
    
}
