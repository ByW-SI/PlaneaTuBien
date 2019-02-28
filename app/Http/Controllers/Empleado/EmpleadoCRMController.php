<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Http\Controllers\Controller;
use App\ProspectoCRM;
use Illuminate\Http\Request;

class EmpleadoCRMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Empleado $empleado)
    {
        //
        // dd($request->all());
        if($request->desde && $request->hasta){
            $crms=$empleado->crms()->whereBetween('fecha_contacto',[$request->desde,$request->hasta])->orderBy('fecha_aviso','asc')->get();
        }
        elseif ($request->desde && !$request->hasta) {
            // dd("si entra");
            $crms=$empleado->crms()->where('fecha_contacto','>=',$request->desde)->orderBy('fecha_aviso','asc')->get();
        }
        elseif ($request->hasta && !$request->desde) {
            // dd("si entra");
            $crms=$empleado->crms()->where('fecha_contacto','<=',$request->hasta)->orderBy('fecha_aviso','asc')->get();
        }
        else{
            $crms=$empleado->crms()->orderBy('fecha_aviso','asc')->get();
            
        }
        return view('empleado.crm.index',['empleado'=>$empleado,'crms'=>$crms,'desde'=>$request->desde,'hasta'=>$request->hasta]);
    }

}
