<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpleadoFalta extends Model
{
    use SoftDeletes;
    //
    protected $fillable=['id','empleado_id','fecha','tipofalta','motivo'];
    
    protected $hidden=['created_at','updated_at'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public function empleado(){
    	return $this->belongsTo('App\Empleado','empleado_id');
    }
}
