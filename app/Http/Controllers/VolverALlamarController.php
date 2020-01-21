<?php

namespace App\Http\Controllers;

use App\Prospecto;
use Illuminate\Http\Request;

class VolverALlamarController extends Controller
{
    public function index()
    {
        $prospectos = Prospecto::whereEstatusVolverALlamar()->get();
        return view('prospectos.volver_a_llamar.index', compact('prospectos'));
    }
}
