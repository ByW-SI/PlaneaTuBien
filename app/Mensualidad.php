<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    protected $table = "mensualidades";

    protected $fillable=[
    	'id',
    	'contrato_id',
    	'num_mes',
    	'cantidad',
    	'fecha',
    	'recargo',
    	'pagado'
    ];

    protected $hidden =[
    	'created_at',
    	'updated_at',
    ];

    public function plans(){
    	return $this->belongsTo('App\Contrato');
    }

    public function pagos(){
        return $this->hasMany('App\Pagos');
    }
}
