<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilDatosPersonalCliente extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
		'prospecto_id',
    	'prefijo_1',
		'paterno_1',
		'materno_1',
		'nombre_1',
		'folio',
		'ocupacion_1',
		'empresa_1',
		'antiguedad_1',
		'salario_1',
		'rfc_1',
		'nacionalidad_1',
		'prefijo_2',
		'paterno_2',
		'materno_2',
		'nombre_2',
		'ocupacion_2',
		'empresa_2',
		'antiguedad_2',
		'salario_2',
		'rfc_2',
		'nacionalidad_2',
		'estado_civil',
		'regimen_matrimonial',
		'calle',
		'numero_ext',
		'numero_int',
		'colonia',
		'municipio',
		'estado',
		'cp',
		'telefono_casa',
		'telefono_celular',
		'telefono_oficina',
		'email',
		'tipo_residencia',
		'habitantes',
		'duenio_residencia',
		'costo_residencia',
		'tiempo_viviendo',
		'hijos',
		'numero_hijos',
		'dependientes_economicos',
		'numero_dependientes',
		'ingresos_extras',
		'ingreso_total',
		'ahorro_inicial',
		'forma_ahorro',
		'ahorra',
		'ahorros',
		'tipo_ahorro',
		'otro_participante',
		'participante'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];


    public function prospecto()
    {
    	return $this->belongsTo('App\Prospecto','prospecto_id','id');
    }

    public function asesor()
    {
    	return $this->belongsTo('App\Empleado','empleado_id','id');
    }

    public function cotizacion()
    {
    	return $this->belongsTo('App\Cotizacion');
    }

    public function historial_crediticio()
    {
    	return $this->hasOne('App\PerfilHistorialCrediticioCliente','perfil_id' ,'id');
    }

    public function inmueble_pretendido(){
    	return $this->hasOne('App\PerfilInmueblePretendidoCliente','perfil_id','id');
    }
    public function referencia_personals()
    {
    	return $this->hasMany('App\PerfilReferenciaPersonalCliente','perfil_id','id');
    }
    public function presolicitud(){
    	return $this->hasOne('App\Presolicitud','perfil_id','id');
    }

}
