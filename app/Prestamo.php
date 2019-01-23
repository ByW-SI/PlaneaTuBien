<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    
    protected $table = 'prestamos';

    protected $fillable = [
    	'id',
    	'prospecto_id',
    	'prestamo',
    	'meses'
    ];

    public function prospecto() {
    	return $this->belongsTo('App\Prospecto');
    }
}
