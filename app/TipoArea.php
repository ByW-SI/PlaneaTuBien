<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoArea extends Model
{
    //
    use SoftDeletes;
    protected $fillable=[
    	'id',
    	'nombre',
    	'descripcion',
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=['deleted_at'];

    public function datosLab(){
    	return $this->hasMany('App\EmpleadosDatosLab');
    }
}
