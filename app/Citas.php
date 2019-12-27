<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    protected $table = 'citas';

	protected $fillable = [
        'id',
        'seguimientoLlamada_id',
        'fechaSiguienteContacto',
        'HoraSiguienteContacto',
        'fechaSiguienteCita',
        'HoraSiguienteCita',
        'comentarios',
        'estatusLlamada'
    ];
    
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
}
