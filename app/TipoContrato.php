<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoContrato extends Model
{
    use SoftDeletes;
    protected $fillable=[
    	'id',
    	'nombre',
        'descripcion',
        'codigo'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=['deleted_at'];

    public function datosLab(){
    	return $this->hasMany('App\EmpleadosDatoLab');
    }
}
