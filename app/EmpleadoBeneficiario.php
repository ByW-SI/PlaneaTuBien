<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoBeneficiario extends Model
{
    use SoftDeletes;
    //

    protected $fillable=[
    	'nombre',
    	'appaterno',
    	'apmaterno',
    	'parentesco',
    	'rfc',
    	'calle',
    	'num_ext',
    	'num_int',
    	'colonia',
    	'municipio',
    	'estado',
    	'telefono',
    	'unidad_medica',
    	'turno_atencion'
    ];
    protected $hidden=[
    	'created_at',
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
    	return $this->belongsTo('App\Empleado');
    }
}
