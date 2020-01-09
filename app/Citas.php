<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    protected $table = 'citas';

	protected $fillable = [
        'id',
        'prospecto_id',
        'clave_preautorizacion',
        'fecha_cita',
        'hora'
    ];
    
    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function prospecto(){
        return $this->belongsTo('App\Prospecto');
    }
}