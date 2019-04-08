<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    //
    protected $fillable=[
    	'nombre',
    	'plazo',
    	'mes_aportacion_adjudicado',
    	'mes_adjudicado',
    	'aportacion_1',
    	'mes_1',
    	'aportacion_2',
    	'mes_2',
    	'aportacion_3',
    	'mes_3',
    	'aportacion_liquidacion',
    	'mes_liquidacion',
    	'semestral',
    	'anual',
    	'inscripcion',
    	'cuota_admon',
    	's_v',
    	's_d'
    ];
    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];
    protected $dates=[
    	'deleted_at'
    ];
}
