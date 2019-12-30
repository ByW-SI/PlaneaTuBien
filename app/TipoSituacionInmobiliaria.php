<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSituacionInmobiliaria extends Model
{
    protected $table = 'tipo_situacion_inmobiliarias';

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
