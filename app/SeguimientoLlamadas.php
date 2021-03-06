<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeguimientoLlamadas extends Model
{
    protected $table = 'seguimiento_llamadas';

    protected $fillable = [
        'id',
        'asesor_id',
        'prospecto_id',
        'resultado_llamada_id',
        'fecha_contacto',
        'fecha_siguiente_contacto',
        'comentario',
        'responsable_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function asesor()
    {
        return $this->belongsTo('App\EmpleadoProspecto');
    }

    public function prospecto()
    {
        return $this->belongsTo('App\Prospecto');
    }

    public function resultadoLLamada()
    {
        return $this->belongsTo('App\ResultadoLlamada', 'resultado_llamada_id');
    }

    public function citas()
    {
        return $this->hasMany('App\Citas', 'seguimientoLlamada_id');
    }

    public function responsable(){
        return $this->belongsTo('App\Empleado');
    }
}
