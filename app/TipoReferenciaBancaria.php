<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoReferenciaBancaria extends Model
{
    protected $table = 'tipo_referencia_bancarias';

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
