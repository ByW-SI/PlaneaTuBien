<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
    protected $table = "integrantes";
    protected $fillable = ["prospecto_id"];

    public function prospecto()
    {
        return $this->belongsTo('App\Prospecto');
    }
}
