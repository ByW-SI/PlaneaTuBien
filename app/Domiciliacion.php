<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domiciliacion extends Model
{
    //

    protected $table="domiciliacions";
    protected $fillable=[
    	'emisor',
    	'referencia',
    	'titular',
    	'banco',
    	'tipo',
    	'numero',
        'monto'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates = [
    	'deleted_at'
    ];

    public function contrato()
    {
    	return $this->belongsTo('App\Contrato','contrato_id','id');
    }
}
