<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoPermiso extends Model
{
    use SoftDeletes;
    //

    protected $fillable=[
    	'tipopermiso',
    	'permiso',
    	'fecha',
    	'fechainicio',
    	'fechafin',
    	'horainicio',
    	'horafin',
    	'diastotales',
    	'horastotales',
    	'motivo'
    ];
    protected $hidden=[
    	'crated_at',
    	'updated_at'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public function empleado()
    {
    	return $this->belongsTo('App\Empleado','empleado_id');
    }
    public function getTipoAttribute(){
    	$tipo = $this->tipopermiso;
    	$message = "";
    	if($tipo == "dia"){
    		$message =  "Por día";
    	}
    	elseif($tipo == "hora"){
    		$message =  "Por horas";
    	}
    	else{
    		$message =  "este tipo es invalido, contacte con soporte tecnico";
    	}
    	return $message;
    }
    public function getPermAttribute()
    {
    	$permiso = $this->permiso;
    	$message="";
    	if ($permiso == "con_sueldo") {
    		$message = "Con goce de sueldo";
    	}
    	elseif ($permiso == "sin_sueldo") {
    		$message = "Sin goce de sueldo";
    	}
    	elseif ($permiso == "tiempo") {
    		$message = "Tiempo por tiempo";
    	}
    	else{
    		$message =  "este dato es invalido, contacte con soporte tecnico";
    	}
    	return $message;
    }
    public function getInicioAttribute()
    {
    	$tipo = $this->tipopermiso;
    	if($tipo == "dia"){
    		return $this->fechainicio;
    	}
    	elseif($tipo == "hora"){
    		return $this->horainicio;
    	}
    	else{
    		return "este dato es invalido, contacte con soporte tecnico";
    	}
    }
    public function getFinalAttribute()
    {
    	$tipo = $this->tipopermiso;
    	if($tipo == "dia"){
    		return $this->fechafin;
    	}
    	elseif($tipo == "hora"){
    		return $this->horafin;
    	}
    	else{
    		return "este dato es invalido, contacte con soporte tecnico";
    	}	
    }
    public function getTotalAttribute()
    {
    	$tipo = $this->tipopermiso;
    	if($tipo == "dia"){
    		return $this->diastotales." dias";
    	}
    	elseif($tipo == "hora"){
    		return $this->horastotales." horas";
    	}
    	else{
    		return "este dato es invalido, contacte con soporte tecnico";
    	}
    }
}
