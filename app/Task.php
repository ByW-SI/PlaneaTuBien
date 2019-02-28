<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'nombre',
    	'descripcion'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];

    public function crms(){
    	return $this->belongsToMany('App\ProspectoCRM','crm_task','task_id','crm_id')->withPivot('hecho');
    }
}
