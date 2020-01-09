<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    protected $table = 'prospectos';

    protected $fillable = [
        'id',
        'empleado_id',
        'estatus_id',
        'nombre',
        'appaterno',
        'apmaterno',
        'sexo',
        'email',
        'telefono',
        'celular',
        'sueldo',
        'estado_civil',
        'edad',
        'nombreConyuge',
        'edadConyugue',
        'montoProyecto',
        'celular_2',
        'telefonoOficina',
        'telefonoConyugue',
        'telefonoCasa',
        'email_2',
        'numeroTarjetas'
    ];

    protected $hidden=[
        'created_at',
        'updated_at',
        'deleted_at',
        'empleado_id',

    ];
    protected $dates=[
        'deleted_at'
    ];
    public function getFullNameAttribute()
    {
        return $this->nombre." ".$this->appaterno." ".$this->apmaterno;
    }

    public function asesores() {
        return $this->belongsToMany('App\Empleado')
                    ->using('App\EmpleadoProspecto')
                    ->withPivot('temporal', 'activo', 'fechaInicioTemporal', 'fechaFinTemporal');
    }

    public function asesor(){
        return $this->asesores()->having('pivot_temporal', '0');
    }

    public function empleado(){
        return $this->belongsTo('App\Empleado');
    }

    public function estatus() {
        return $this->belongsTo('App\EstatusProspecto');
    }

    public function documentos() {
        return $this->hasOne('App\Documento');
    }

    public function cotizaciones() {
        return $this->hasMany('App\Cotizacion');
    }

    public function pago_inscripcions() {
        return $this->hasMany('App\PagoInscripcion');
    }

    public function crms(){
        return $this->hasMany('App\ProspectoCRM')->orderBy('fecha_aviso','asc');
    }

    public function perfil(){
        return $this->hasOne('App\PerfilDatosPersonalCliente','prospecto_id','id');
    }

    public function seguimientoLlamadas(){
        return $this->hasMany('App\SeguimientoLlamadas', 'prospecto_id', 'id');
    }


}
