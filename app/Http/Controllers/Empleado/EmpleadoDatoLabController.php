<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoDatoLab;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmpleadoDatoLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        //
        $dato_lab= $empleado->datos_laborales->last();
        $historial = $empleado->datos_laborales()->paginate(5);
        return view('empleado.datoslaborales.index',['empleado'=>$empleado,'dato_lab'=>$dato_lab,'historial'=>$historial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function show(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }
}
