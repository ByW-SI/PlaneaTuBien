<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use Carbon\Carbon;
use App\EmpleadoVacacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoVacacionController extends Controller
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
        
        $vacaciones = $empleado->vacaciones;
        if($empleado->datos_laborales->isEmpty())
            $antiguedad=0;
        else
        {
            $fecha_contratacion=$empleado->datos_laborales->first()->fecha_contrato;
            $antiguedad= new Carbon($fecha_contratacion);
            $antiguedad= $antiguedad->age;    
        }
        
        
        $diastotales = 0;
        if ($antiguedad == 1) 
            $diastotales = 6;
        elseif($antiguedad == 2)
            $diastotales = 8;
        elseif($antiguedad == 3)
            $diastotales = 10;
        elseif($antiguedad == 4)
            $diastotales = 12;
        elseif($antiguedad >= 5)
            $diastotales = 14;
        else
            $diastotales = 0;

        $diasdisfrutados= 0;
        foreach ($empleado->vacaciones as $vacacion) {
            $diasdisfrutados += $vacacion->dias_tomados;

        }

        return "Bien 2";

        return view('empleado.vacacion.view',['empleado'=>$empleado, 'vacaciones'=>$vacaciones,'antiguedad'=>$antiguedad,'diastotales'=>$diastotales,'diasdisfrutados'=>$diasdisfrutados]);
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
    public function store(Request $request, Empleado $empleado)
    {
        $vacacion = new EmpleadoVacacion($request->all());
        $empleado->vacaciones()->save($vacacion);
        Alert::success('Información Agregada', 'Se ha registrado correctamente la información');
        return redirect()->route('empleados.vacacions.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoVacacion  $empleadoVacacion
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoVacacion  $empleadoVacacion
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
     * @param  \App\EmpleadoVacacion  $empleadoVacacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoVacacion  $empleadoVacacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
