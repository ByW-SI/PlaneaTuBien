<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    protected $table = "mensualidades";
<<<<<<< HEAD
    protected $fillable = ['pagado', 'contrato_id', 'abono', 'cantidad', 'fecha', 'recargo'];
=======
<<<<<<< HEAD

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
=======
    protected $fillable = ['pagado', 'contrato_id', 'num_mes', 'cantidad', 'fecha', 'recargo'];
>>>>>>> b4590f35fedb3102a2d71ccd71db02c0485427d6
>>>>>>> 4e97cbd21788e81f6fd4045588dc4f38123a5ca9

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
