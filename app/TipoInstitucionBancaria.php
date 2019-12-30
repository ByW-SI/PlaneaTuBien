<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoInstitucionBancaria extends Model
{
    protected $table = 'tipo_institucion_bancarias';

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
