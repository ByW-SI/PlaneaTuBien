<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskSendMail extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'crm_id',
    	'cotizacion_id'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];

    public function crm()
    {
    	return $this->belongsTo('App\ProspectoCRM', 'crm_id','id');
    }
    public function cotizacion()
    {
    	return $this->belongsTo('App\Cotizacion', 'cotizacion_id','id');
    }
}
