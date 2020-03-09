<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedioContacto extends Model
{
    protected $table = "medios_contacto";
    protected $fillable = ["nombre","descripcion"];
}
