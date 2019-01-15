<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

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
}
