<?php

namespace App\Http\Controllers;

use App\EmpleadoProspecto;
use App\Prospecto;

class PruebasController extends Controller
{
    public function index()
    {
        return Prospecto::where('id', 26)
            ->with('asesores')
            ->with('asesor')
            ->get();
    }
}
