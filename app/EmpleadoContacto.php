<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoContacto extends Model
{

    protected $table = 'empleadocontactos';

    protected $fillable = [
        'id',
        'empleado_id',
        'telefono',
        'celular',
        'correo'
    ];

    public function empleado(){
        return $this->belongsTo('App\Empleado');
    }
}
