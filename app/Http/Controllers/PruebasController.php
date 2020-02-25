<?php

namespace App\Http\Controllers;

use App\Grupo;

class PruebasController extends Controller
{
    public function index()
    {
        $grupo = Grupo::with('contrato')->first();
        return $grupo;
        return view('pruebas.index');
    }
}
