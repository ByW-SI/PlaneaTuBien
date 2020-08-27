<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    protected $table = "mensualidades";

    protected $fillable = ['pagado', 'contrato_id', 'abono', 'cantidad', 'fecha', 'recargo','puntos','descripcion'];

    protected $hidden =[
    	'created_at',
    	'updated_at',
    ];

    public function plans(){
    	return $this->belongsTo('App\Contrato');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pagos');
    }

    /**
     * Scope methods
     */

    public function ScopeLast($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
