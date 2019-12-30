<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoProspecto extends Pivot
{
    protected $table = 'empleado_prospecto';

    public function seguimientoLlamadas(){
        return $this->hasMany('App\SeguimientoLlamadas', 'asesor_id', 'empleado_id');
    }

}
