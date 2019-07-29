<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoEmergencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoEmergenciaController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                foreach (Auth::user()->perfil->componentes as $componente)
                    if($componente->modulo->nombre == "rh")
                        return $next($request);
                return redirect()->route('denegado');
            } else
                return redirect()->route('login');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        $emergencia = $empleado->emergencia;
        if ($emergencia == null) {
            # code...
            return redirect()->route('empleados.emergencias.create',['empleado'=>$empleado]);
        }
        else {

            return view('empleado.emergencia.view',['empleado'=>$empleado, 'emergencia'=>$emergencia]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        $emergencia = new EmpleadoEmergencia;
        $edit = false;
        return view('empleado.emergencia.create',['empleado'=>$empleado,'emergencia'=>$emergencia,'edit'=>$edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empleado $empleado)
    {
        $emergencia = new EmpleadoEmergencia($request->all());
        $empleado->emergencia()->save($emergencia);
        Alert::success('Registro guardado', 'Siga agregando información al empleado');
        // $emergencias = EmpleadoEmergencia::create($request->all());
        return redirect()->route('empleados.emergencias.index',['empleado'=>$empleado,'emergencia'=>$emergencia]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoEmergencia  $empleadoEmergencia
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoEmergencia  $empleadoEmergencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado, $emergencia)
    {
        $emergencia = $empleado->emergencia;
        $edit = true;
        return view('empleado.emergencia.create',['empleado'=>$empleado, 'emergencia'=>$emergencia,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoEmergencia  $empleadoEmergencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado, $emergencia)
    {
        $emergencia = $empleado->emergencia;
        $emergencia->update($request->all());
        Alert::success('Registro actualizado', 'Siga agregando información al empleado');
        return redirect()->route('empleados.emergencias.index',['empleado'=>$empleado,'emergencia'=>$emergencia]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoEmergencia  $empleadoEmergencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoEmergencia $empleadoEmergencia)
    {
        //
    }
}
