<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    //

    protected $fillable=[
    	'monto',
    ];
    protected $hidden =[
    	'created_at',
    	'deleted_at',
    	'updated_at'
    ];
    protected $date=[
    	'created_at',
    	'deleted_at',
    	'updated_at'
    ];

    public function grupo()
    {
    	return $this->belongsTo('App\Grupo');
    }

    public function recibo()
    {
    	return $this->belongsTo('App\Recibo');
    }

    public function domiciliacion()
    {
        return $this->hasOne('App\Domiciliacion');
    }
    public function checklist()
    {
        return $this->hasOne('App\ChecklistFolder');
    }

    public function pagoMensual()
    {
        return $this->hasMany('App\PagoMensual');
    }
}
