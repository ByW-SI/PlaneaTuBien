<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    
    protected $table = 'documentos';

    protected $fillable = [
    	'id',
    	'prospecto_id',
    	'nacimiento',
    	'nacionalidad',
    	'lugar',
    	'civil',
    	'profesion',
    	'empresa',
    	'actual',
    	'anterior',
    	'antiguo',
    ];

    public function prospecto() {
    	return $this->belongsTo('App\Prospecto');
    }
}
