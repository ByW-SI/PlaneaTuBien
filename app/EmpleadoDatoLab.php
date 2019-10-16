<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoDatoLab extends Model
{
    //
    use SoftDeletes;
    
    protected $fillable=[
    	'periodo_paga',
    	'regimen',
    	'lugar_trabajo',
    	'contrato_id',
    	'area_id',
    	'puesto_id',
    	'salario_nomina',
    	'salario_dia',
    	'prestaciones',
    	'hora_entrada',
    	'hora_comida',
    	'hora_salida',
    	'fecha_contrato',
    	'banco',
    	'cuenta',
    	'clabe',
    	'fecha_baja',
    	'baja_id',
    	'comentario_baja',
		'puntualidad',
		'tipo_jornada_id',
		'riesgo_puesto',
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];
    protected $dates = ['deleted_at'];

    public function empleado(){
    	return $this->belongsTo('App\Empleado');
    }

    public function area()
    {
    	return $this->belongsTo('App\TipoArea','area_id','id');
    }
    public function contrato(){
    	return $this->belongsTo('App\TipoContrato','contrato_id','id');
    }
    public function baja()
    {
    	return $this->belongsTo('App\TipoBaja','baja_id','id');
    }
    public function puesto()
    {
    	return $this->belongsTo('App\TipoPuesto','puesto_id','id');
	}
	
	public function tipo_jornada(){
		return $this->belongsTo('App\TipoJornada','tipo_jornada_id','id');
	}

}
