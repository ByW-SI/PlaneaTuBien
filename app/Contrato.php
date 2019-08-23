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

    public function presolicitud()
    {
    	return $this->belongsTo('App\Presolicitud');
    }

    public function domiciliacion()
    {
        return $this->hasOne('App\Domiciliacion');
    }
    public function checklist()
    {
        return $this->hasOne('App\ChecklistFolder');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pagos');
    }

    public function estadoFinanciero()
    {
        return $this->hasOne('App\EstadoFinanciero');
    }

    /**
     * Scope methods
     */

    public function scopeRegistrados($query){
        return $query->where('estado','registrado');
    }
}
