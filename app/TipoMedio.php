<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMedio extends Model
{
    protected $table = 'tipo_medios';

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
