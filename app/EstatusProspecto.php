<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstatusProspecto extends Model
{
    protected $table = "estatus_prospecto";

    protected $fillable = [
    	'id',
    	'nombre'
    ];

    public function prospectos()
    {
    	return $this->hasMany('App\Prospecto');
    }
}
