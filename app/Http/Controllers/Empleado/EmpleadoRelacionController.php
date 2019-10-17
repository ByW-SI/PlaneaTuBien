<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoRelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $empleado = Empleado::withTrashed()->find($id);
        return view('empleado.empleados.index', ['empleados'=>$empleado->empleados, 'empleado'=>$empleado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        $empleados = Empleado::where('id', '!=', 1);
        switch ($empleado->tipo) {
            case 'Supervisor':
                $empleados = $empleados->where('tipo', 'Asesor')->where('id_jefe', null)->get();
                break;

            case 'Gerente':
                $empleados = $empleados->where('tipo', 'Supervisor')->where('id_jefe', null)->get();
                break;            
            
            default:
                # code...
                break;
        }
        return view('empleado.empleados.create',['empleado'=>$empleado, 'empleados' => $empleados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empleado $empleado)
    {
        // dd($empleado);
        $empleado2 = Empleado::find($request->input('empleado'));
        $empleado2->jefe()->associate($empleado);
        $empleado2->save();
        return redirect()->route('empleados.relaciones.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado, $relacion, Request $request)
    {
        $subEmpleado = Empleado::find($relacion);
        $subEmpleado->id_jefe = null;
        $subEmpleado->save();
        return redirect()->route('empleados.relaciones.index',['empleado'=>$empleado]);
    }
}
