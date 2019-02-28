<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPromocion extends Model
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

    public function promociones()
    {
    	return $this->hasMany('App\Promocion');
    }
}
