<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitaCancelada extends Model
{
    protected $table = "citas_canceladas";
    protected $fillable = ["cita_id", "comentario", "asesor_confirmador_id", "tipo_cancelacion"];

    /**
     * =========
     * RELATIONS
     * =========
     */

    public function asesor()
    {
        return $this->belongsTo('App\Empleado', 'asesor_confirmador_id', 'id');
    }
}
