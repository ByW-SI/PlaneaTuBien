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
        'hora',
        'esta_confirmada'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function prospecto()
    {
        return $this->belongsTo('App\Prospecto');
    }

    public function citaCancelada()
    {
        return $this->hasOne('App\CitaCancelada', 'cita_id', 'id');
    }

    /**
     * =====
     * SCOPE
     * =====
     */

    public function scopeNoConfirmadas($query){
        return $query->where('esta_confirmada',0);
    }

    public function scopeConfirmadas($query)
    {
        return $query->where('esta_confirmada', 1);
    }

    public function scopeCanceladas($query)
    {
        return $query->has('citaCancelada');
    }

    public function scopeNoCanceladas($query){
        return $query->doesntHave('citaCancelada');
    }
}
