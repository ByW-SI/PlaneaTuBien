<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEstadoCivil extends Model
{
    protected $table = 'tipo_estado_civils';

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
