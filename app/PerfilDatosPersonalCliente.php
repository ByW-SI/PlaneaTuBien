<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilDatosPersonalCliente extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'prefix_1',
		'prefix_2',
		'nombre_completo_1',
		'nombre_completo_2',
		'ocupacion_1',
		'ocupacion_2',
		'empresa_1',
		'empresa_2',
		'antiguedad_1',
		'antiguedad_2',
		'salario_1',
		'salario_2',
		'rfc_1',
		'rfc_2',
		'nacionalidad_1',
		'nacionalidad_2',
		'estado_civil',
		'regimen_matrimonial',
		'direccion',
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

}
