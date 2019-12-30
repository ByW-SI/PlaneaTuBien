<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCitasAsistidas extends Model
{
    protected $table = 'tipo_citas_asistidas';

	protected $fillable = [
        'id',
        'nombre',
        'codigo'
    ];
    
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
}
