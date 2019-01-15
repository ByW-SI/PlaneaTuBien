<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'id',
        'nombre',
        'paterno',
        'materno',
        'id_empleado',
        'rfc',
        'nacimiento',
        'lugarnacimiento',
        'nacionalidad',
        'sexo',
        'edad',
        'estadocivil',
        'prefesion',
        'empresa',
        'puestoactual',
        'antiguedad',
        



    ];
}
