<?php

namespace App\Http\Controllers\Empleado;

use App\EmpleadoDireccion;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoDireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        return view('empleado.empleadodireccion.index', ['direcciones'=>$empleado->direcciones, 'empleado'=>$empleado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        return view('empleado.empleadodireccion.create' ,['empleado'=>$empleado]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empleado $empleado)
    {
        $empleado->direcciones()->save(new EmpleadoDireccion($request->all()));
        return redirect()->route('empleados.direcciones.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoDireccion  $empleadoDireccion
     * @return \Illuminate\Http\Response
     */
    public function show(EmpleadoDireccion $empleadoDireccion)
    {
        return view('empleado.empleadodireccion.show', ['empleado'=>$empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoDireccion  $empleadoDireccion
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleadoDireccion $empleadoDireccion)
    {
        return view('empleado.empleadodireccion.edit', ['empleado'=>$empleadoDireccion]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoDireccion  $empleadoDireccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoDireccion $empleadoDireccion)
    {
        $empleadoDireccion->update($request->all());
        return redirect()->route('empleados.direcciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoDireccion  $empleadoDireccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoDireccion $empleadoDireccion)
    {
        $empleadoDireccion->delete();
        return redirect()->route('empleados.direcciones.index');
    }
}