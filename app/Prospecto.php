<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    protected $table = 'prospectos';

    protected $fillable = [
        'id',
        'empleado_id',
        'nombre',
        'appaterno',
        'apmaterno',
        'sexo',
        'email',
        'tel',
        'movil',
        'monto',
        'plan',
    ];

    public function asesor() {
        return $this->belongsTo('App\Empleado', 'empleado_id');
    }

    public function documentos() {
        return $this->hasOne('App\Documento');
    }

    public function cotizaciones() {
        return $this->hasMany('App\Cotizacion');
    }

    public function pagos() {
        return $this->hasMany('App\Pago');
    }

    public function crms(){
        return $this->hasMany('App\ProspectoCRM')->orderBy('fecha_aviso','asc');
    }

}
