<?php

namespace App\Http\Controllers;

use App\EmpleadoProspecto;
use App\Prospecto;

class PruebasController extends Controller
{
    public function index()
    {
        $prospecto = Prospecto::with('cotizaciones')->find(3);
        return $prospecto;
    }
}
