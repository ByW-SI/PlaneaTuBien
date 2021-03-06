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

    protected $dates = ['deleted_at'];

    public function clientes()
    {
        return $this->hasOne('App\Cliente');
    }

    public function contactos()
    {
        return $this->hasMany('App\EmpleadoContacto');
    }

    public function direccion()
    {
        return $this->hasOne('App\EmpleadoDireccion');
    }

    public function accidentes()
    {
        return $this->hasMany('App\EmpleadoAccidente');
    }

    public function beneficiario()
    {
        return $this->hasOne('App\EmpleadoBeneficiario');
    }

    public function permisos()
    {
        return $this->hasMany('App\EmpleadoPermiso');
    }

    public function faltas()
    {
        return $this->hasMany('App\EmpleadoFalta');
    }


    public function jefe()
    {
        return $this->belongsTo('App\Empleado', 'id_jefe', 'id');
    }

    public function empleados()
    {
        return $this->hasMany('App\Empleado', 'id_jefe', 'id');
    }

    public function sucursal()
    {
        return $this->belongsTo('App\Sucursal');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function datos_laborales()
    {
        return $this->hasMany('App\EmpleadoDatoLab');
    }

    public function estudio()
    {
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

    public function prospectos()
    {
        return $this->belongsToMany('App\Prospecto')
            ->using('App\EmpleadoProspecto')
            ->withPivot('temporal', 'activo', 'fechaInicioTemporal', 'fechaFinTemporal');
    }

    public function prospectosActuales()
    {
        $prospectosDentroDeFechaFin = $this->prospectos()->wherePivot('fechaFinTemporal', '>', date('Y-m-d'))->wherePivot('activo', 1)->get();
        $prospectosSinFechaFin = $this->prospectos()->wherePivot('fechaFinTemporal', '=', null)->wherePivot('activo', 1)->get();
        $prospectosActuales = $prospectosDentroDeFechaFin->merge($prospectosSinFechaFin)->pluck('id')->flatten()->toArray();
        return $this->id == 1 ? Prospecto::where('id', '>', 0) : Prospecto::whereIn('id', $prospectosActuales);
    }

    public function crms()
    {
        return $this->hasManyThrough('App\ProspectoCRM', 'App\Prospecto');
    }

    /**
     * ==========
     * ATTRIBUTES
     * ==========
     */

    public function getEsAsesorAttribute()
    {
        return strtolower($this->puesto) == 'asesor';
    }

    public function getFullNameAttribute()
    {
        return $this->nombre . " " . $this->paterno . " " . $this->materno;
    }

    public function getInicialesAttribute()
    {
        $inicialNombre = $this->nombre ? $this->nombre[0] : '';
        $inicialPaterno = $this->paterno ? $this->paterno[0] : '';
        return $inicialNombre . $inicialPaterno;
    }

    /**
     * =============
     * SCOPE METHODS
     * =============
     */

    public function scopeNoUsers($query)
    {
        $users_id = User::whereNotNull('empleado_id')->pluck('empleado_id')->all();
        return $query->whereNotIn('id', $users_id);
    }

    public function scopeDirectivos($query)
    {
        return $query->where('puesto', 'Directivo');
    }

    public function gerentes($query)
    {
        return $query->where('cargo', 'Gerente');
    }

    public function scopeAsesores($query)
    {
        return $query->where('cargo', 'Asesor');
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function esAdmin()
    {
        return $this->tipo == 'Admin' ? true : false;
    }

    public function tieneProspecto(Prospecto $prospecto)
    {
        return !is_null($this->prospectos()->find($prospecto->id));
    }
}
