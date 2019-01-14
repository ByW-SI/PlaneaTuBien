<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $table = 'empleados';

    protected $fillable = [
        'id',
        'tipo',
        'nombre',
        'paterno',
        'materno',
        'edad',
        'sexo',
        'sucursal',
        'cargo',
        'supervisor_al_que_pertenece',
        'gerente_al_que_pertenece',

    ];
}
