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
        'id_supervisor',
        'id_gerente'


    ];

    public function contacto(){
        return $this->hasMany('App\EmpleadoContacto');
    }

    public function direccion(){
        return $this->hasMany('App\EmepladoDireccion');
    }

    public function sucursal(){
        return $this->belongsTo('App\Sucursal', 'id_sucursal');
    }

    public function supervisor(){
        return $this->belongsTo('App\Empleado', 'id_supervisor');
    }

    public function gerente(){
        return $this->belongsTo('App\Empleado', 'id_gerente');
    }
}
