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
        'fecha_nacimiento',
        'edad',
        'sexo',
        'email',
        'sucursal_id',
        'cargo',
        'puesto',
        'id_jefe',
        'status',
        'rfc',
        'telefono',
        'movil',
        'nss',
        'curp',
        'infonavit',
        'fecha_baja',
        'motivo_baja',
        'es_reingresable',
        'es_recomendable'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates=['deleted_at'];

    public function getFullNameAttribute()
    {
        return $this->nombre." ".$this->paterno." ".$this->materno;
    }

    public function clientes() {
        return $this->hasOne('App\Cliente');
    }

    public function contactos(){
        return $this->hasMany('App\EmpleadoContacto');
    }

    public function direcciones(){
        return $this->hasMany('App\EmpleadoDireccion');
    }

    public function accidentes(){
        return $this->hasMany('App\EmpleadoAccidente');
    }

    public function beneficiario(){
        return $this->hasOne('App\EmpleadoBeneficiario');
    }

    public function permisos()
    {
        return $this->hasMany('App\EmpleadoPermiso');
    }

    public function faltas(){
        return $this->hasMany('App\EmpleadoFalta');
    }


    public function jefe(){
        return $this->belongsTo('App\Empleado', 'id_jefe', 'id');
    }

    public function empleados(){
        return $this->hasMany('App\Empleado', 'id_jefe', 'id');
    }

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
        return $this->hasOne('App\EmpleadoEstudio');
    }
    public function emergencia()
    {
        return $this->hasOne('App\EmpleadoEmergencia');
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

    /**
     * Scope methods
     */

    public function scopeNoUsers($query){
        $users_id = User::whereNotNull('empleado_id')->pluck('empleado_id')->all();
        return $query->whereNotIn('id',$users_id);
    }
    
}
