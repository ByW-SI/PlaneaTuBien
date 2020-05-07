<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TipoPuesto;

class ApiPuestoController extends Controller
{
    public function getJefe($puesto){
        $jefe = TipoPuesto::where('nombre',$puesto)->first()->jefe;
        return response()->json($jefe);
    }
}
