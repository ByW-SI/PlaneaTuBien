<?php

namespace App\Http\Controllers;

use App\EmpleadoProspecto;
use App\Prospecto;

class PruebasController extends Controller
{
    public function index()
    {
        $empleadoProspecto = EmpleadoProspecto::where('prospecto_id', 2)->update([
            'temporal' => 1
        ]);
        // EmpleadoProspecto::whereIn('id', $empleadoProspecto)->delete();
        // EmpleadoProspecto::where('prospecto_id', 2)->delete();
        return EmpleadoProspecto::where('prospecto_id', 2)->get();
        $prospecto = Prospecto::with('asesores')->find(2);
        // $prospecto->asesores()->detach();
        return $prospecto->asesores()->get();
    }
}
