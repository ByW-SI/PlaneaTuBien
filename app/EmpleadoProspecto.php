<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmpleadoProspecto extends Pivot
{
    protected $table = 'empleado_prospecto';
    protected $fillable = ['prospecto_id', 'empleado_id', 'temporal', 'activo', 'fechaInicioTemporal', 'fechaFinTemporal'];

    public function seguimientoLlamadas()
    {
        return $this->hasMany('App\SeguimientoLlamadas', 'asesor_id', 'empleado_id');
    }
}
