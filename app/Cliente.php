<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'id',
        'nombre',
        'appaterno',
        'apmaterno',
        'empleado_id',
        'rfc',
        'telefono',
        'oficina',
        'celular',
        'email',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'nacionalidad',
        'sexo',
        'edad',
        'estado_civil',
        'profesion',
        'empresa',
        'puesto_actual',
        'puesto_anterior',
        'antiguo',
        'ingreso',
        'calle',
        'numext',
        'numint',
        'colonia',
        'delegacion',
        'estado',
        'cp',
    ];

    public function asesor() {
        return $this->belongsTo('App\Empleado');
    }

}
