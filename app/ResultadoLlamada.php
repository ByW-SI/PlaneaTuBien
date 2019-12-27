<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoLlamada extends Model
{
    protected $table = 'resultado_llamadas';

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
