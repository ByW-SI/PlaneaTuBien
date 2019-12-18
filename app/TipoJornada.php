<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoJornada extends Model
{
    protected $table = "tipo_jornada";

    protected $fillable = ['nombre', 'codigo'];
}
