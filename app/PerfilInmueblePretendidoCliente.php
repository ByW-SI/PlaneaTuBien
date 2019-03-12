<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilInmueblePretendidoCliente extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'tipo_inmueble',
		'precio_aprox',
		'area_inmueble',
		'estado',
		'colonia',
		'recamara',
		'banio',
		'estacionamiento',
		'jardin',
		'gastos_notariales',
		'monto_contratar',
		'tiempo_decision',
		'prioridad',
		'desicion_propia',
		'toma_desicion',
		'lograr_meta',
		'tomaria_desicion',
		'motivo_tomaria_desicion',
		'medio_entero',
		'observaciones'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];

    public function perfil()
    {
    	return $this->belongsTo('App\PerfilDatosPersonalCliente','id','perfil_id');
    }
}
