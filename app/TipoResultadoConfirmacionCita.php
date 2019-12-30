<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoResultadoConfirmacionCita extends Model
{
    protected $table = 'tipo_resultado_confirmacion_citas';

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
