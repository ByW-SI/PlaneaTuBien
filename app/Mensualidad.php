<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    protected $table = "mensualidades";
    protected $fillable = ['pagado'];

    public function pagos(){
        return $this->hasMany('App\Pagos');
    }
}
