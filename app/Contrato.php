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

    public function mensualidades(){
        return $this->hasMany('App\Mensualidad');
    }

    /**
     * Scope methods
     */

    public function scopeRegistrados($query){
        return $query->where('estado','registrado');
    }

    public function getReferenciaAttribute($tipo_pago="1")
    {
        $ref_inicio = str_pad($this->grupo->id, 2, "0", STR_PAD_LEFT).str_pad($this->id, 3, "0", STR_PAD_LEFT).$tipo_pago;
        return $ref_inicio.strtoupper(substr(md5($this->presolicitud->id.$this->id),16));
    }
}
