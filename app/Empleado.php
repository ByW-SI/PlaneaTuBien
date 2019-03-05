<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{

    use SoftDeletes;

    protected $table = 'empleados';

    protected $fillable = [
        'id',
        'tipo',
        'nombre',
        'paterno',
        'materno',
        'email',
        'edad',
        'sexo',
        'sucursal_id',
        'cargo',
        // 'id_jefe',
        'fecha_nacimiento',
        'status',
        'rfc',
        'telefono',
        'movil',
        'nss',
        'curp',
        'infonavit',
        'cp',
        'calle',
        'num_ext',
        'num_int',
        'colonia',
        'municipio',
        'estado',
        'calles',
        'referencia',
        'fecha_baja',
        'motivo_baja'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates=['deleted_at'];

    public function clientes() {
        return $this->hasOne('App\Cliente');
    }

    public function contactos(){
        return $this->hasMany('App\EmpleadoContacto');
    }

    public function direcciones(){
        return $this->hasMany('App\EmpleadoDireccion');
    }

    // public function jefe(){
    //     return $this->belongsTo('App\Empleado', 'id_jefe');
    // }

    // public function empleados(){
    //     return $this->hasMany('App\Empleado', 'id_jefe', 'id');
    // }

    public function sucursal(){
        return $this->belongsTo('App\Sucursal');
    }

    public function user() {
        return $this->hasOne('App\User');
    }

    public function datos_laborales(){
        return $this->hasMany('App\EmpleadoDatoLab');
    }

    public function estudio(){
        return $this->hasOne('App\EmpleadoEstudios');
    }
    public function emergencia()
    {
        return $this->hasOne('App\EmpleadoEmergencias');
    }
    public function vacaciones()
    {
        return $this->hasMany('App\EmpleadoVacacion');
    }

    public function faltas_administrativas()
    {
        return $this->hasMany('App\EmpleadoFaltaAdministrativa');   
    }
    public function prospectos(){
        return $this->hasMany('App\Prospecto','empleado_id','id');
    }
    public function crms(){
        return $this->hasManyThrough('App\ProspectoCRM','App\Prospecto');

    }
    
}
