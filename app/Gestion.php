<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    //
    protected $table = 'gestiones';

    protected $fillable = ['contrato_id', 
    'gestion',
	'fecha_sig'];

    protected $hidden =[
    	'created_at',
    	'updated_at',
    ];


    public function contrato() {
		return $this->belongsTo('App\Contrato');
	}
}
