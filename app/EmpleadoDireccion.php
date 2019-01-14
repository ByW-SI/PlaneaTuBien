<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoDireccion extends Model
{
    protected $table = 'empleadodireccions';

    protected $fillable = [
        'id',
        'id_empleado',
        'calle',
        'exterior',
        'interior',
        'colonia',
        'delegacion',
        'estado',
        'cp'
    ];

    public function empleado(){
        return $this->belongsTo('App\Empleado', 'id_empleado');
    }
}
