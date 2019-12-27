<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeguimientoLlamadas extends Model
{
	protected $table = 'prospectos';

	protected $fillable = [
        'id',
        'empleado_id',
        'clavePreautorizacion',
        'fecha_cita',
        'numTarjetas'
    ];
    
    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function asesor(){
        return $this->belongsTo('App\SeguimientoLlamadas');
    }

    public function citas(){
        return $this->hasMany('App\Citas', 'seguimientoLlamada_id');
    }

}