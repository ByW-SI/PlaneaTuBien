<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoJornada extends Model
{
    protected $table = "tipos_jornadas";

    protected $fillable = ['nombre', 'codigo'];
}
