<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoFaltaAdministrativa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoFaltaAdministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        $disciplinas = $empleado->faltas_administrativas;
        return view('empleado.disciplina.index',['empleado'=>$empleado,'disciplinas'=>$disciplinas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Empleado $empleado)
    {
        $disciplina = new EmpleadoFaltaAdministrativa($request->all());
        $empleado->faltas_administrativas()->save($disciplina);
        Alert::success('Información Agregada', 'Se ha registrado correctamente la información');
        return redirect()->route('empleados.disciplinas.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoFaltaAdministrativa  $empleadoFaltaAdministrativa
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoFaltaAdministrativa  $empleadoFaltaAdministrativa
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
     * @param  \App\EmpleadoFaltaAdministrativa  $empleadoFaltaAdministrativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoFaltaAdministrativa  $empleadoFaltaAdministrativa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
