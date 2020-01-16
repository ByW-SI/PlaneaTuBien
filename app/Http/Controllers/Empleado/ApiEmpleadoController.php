<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiEmpleadoController extends Controller
{
    public function getEmpleado($id){
        $empleado = Empleado::find($id);
        // return response()->json(['id'=>$id],200);
        // return response()->json(['id'=>'ok'],200);
        return response()->json($empleado,200);
    }

    public function getProspectos(Empleado $empleado){
    	return response()->json($empleado->prospectos);
    	// return $empleado->prospectos;
    }
}
