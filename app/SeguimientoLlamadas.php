<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeguimientoLlamadas extends Model
{
	protected $table = 'seguimiento_llamadas';

	protected $fillable = [
        'id',
        'asesor_id',
        'resultado_llamada_id',
        'fecha_contacto',
        'fecha_siguiente_contacto',
        'comentario'
    ];
    
    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function asesor(){
        return $this->belongsTo('App\EmpleadoProspecto');
    }

    public function prospecto(){
        return $this->belongsTo('App\Prospecto');
    }

    public function resultadoLLamada()
    {
        return $this->hasOne('App\ResultadoLlamada');
    }

    public function citas(){
        return $this->hasMany('App\Citas', 'seguimientoLlamada_id');
    }

}