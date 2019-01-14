<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursals';

    protected $fillable = [
        'id',
        'nombre'
    ];

    public function empleados(){
        return $this->hasMany('App\Empleado');
    }
}
