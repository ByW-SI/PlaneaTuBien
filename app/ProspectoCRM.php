<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProspectoCRM extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'fecha_act',
    	'fecha_contacto',
    	'fecha_aviso',
    	'hora_contacto',
    	'status',
    	'comentarios',
    	'acuerdos',
    	'observaciones',
    	'tipo_contacto'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function prospecto(){
    	return $this->belongsTo('App\Prospecto');
    }

    public function tasks(){
        return $this->belongsToMany('App\Task','crm_task','crm_id','task_id')->withPivot('hecho');
    }

    public function task_send_mail()
    {
        return $this->hasOne('App\TaskSendMail','crm_id','id');
    }
}
