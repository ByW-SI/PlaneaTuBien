<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoPermiso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoPermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        $totalPermisosPorDia = 0;
        $totalDiasPermitidos = 0;
        $totalPermisosPorHora = 0;
        $totalHorasPermitidas = 0;

        $permisos = $empleado->permisos;
        // dd($permisos);

        foreach($permisos as $permiso){
            if($permiso->tipopermiso == 'dia'){
                $totalPermisosPorDia += 1;
                $totalDiasPermitidos += $permiso->diastotales;
            }
            if($permiso->tipopermiso == 'hora'){
                $totalPermisosPorHora += 1;
                $totalHorasPermitidas += $permiso->horastotales;
            }
        }

        return view('empleado.permiso.index',compact('empleado','permisos','totalPermisosPorDia','totalDiasPermitidos','totalPermisosPorHora','totalHorasPermitidas'));
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
    public function store(Empleado $empleado, Request $request)
    {
        $permiso = new EmpleadoPermiso($request->all());
        $empleado->permisos()->save($permiso);
        Alert::success('Información Agregada', 'Se ha registrado correctamente la información');
        return redirect()->route('empleados.permisos.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoPermiso  $empleadoPermiso
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoPermiso  $empleadoPermiso
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
     * @param  \App\EmpleadoPermiso  $empleadoPermiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoPermiso  $empleadoPermiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
