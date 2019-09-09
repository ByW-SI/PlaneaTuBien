<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoEstudio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoEstudioController extends Controller
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
    public function index($id)
    {
        $empleado = Empleado::withTrashed()->find($id);
        $estudio = $empleado->estudio;
        if ($estudio == null)
            return redirect()->route('empleados.estudios.create',['empleado'=>$empleado]);
        else 
            return view('empleado.estudio.view',['empleado'=>$empleado, 'estudio'=>$estudio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $empleado = Empleado::withTrashed()->find($id);
        $estudio = new EmpleadoEstudio;
        $edit = false;
        
        return view('empleado.estudio.create',['empleado'=>$empleado,'estudio'=>$estudio,'edit'=>$edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Empleado $empleado)
    {
        $estudio = new EmpleadoEstudio;
        $estudio->empleado_id = $empleado->id;
        $estudio->escolaridad1 = $request->escolaridad1;
        $estudio->institucion1 = $request->institucion1;
        $estudio->cedula1 = $request->cedula1;
        $estudio->escolaridad2 = $request->escolaridad2;
        $estudio->institucion2 = $request->institucion2;
        $estudio->cedula2 = $request->cedula2;
        $estudio->idioma1 = $request->idioma1;
        $estudio->nivel1 = $request->nivel1;
        $estudio->idioma2 = $request->idioma2;
        $estudio->nivel2 = $request->nivel2;
        $estudio->idioma3 = $request->idioma3;
        $estudio->nivel3 = $request->nivel3;
        $estudio->curso1 = $request->curso1;
        if ($request->certificado1 == "on") {
            # code...
            $estudio->certificado1 = true;
        }
        else {
            $estudio->certificado1 = false;   
        }
        $estudio->curso2 = $request->curso2;
        if ($request->certificado2 == "on") {
            # code...
            $estudio->certificado2 = true;
        } else {
            # code...
            $estudio->certificado2 = false;
        }
        $estudio->curso3 = $request->curso3;
        if ($request->certificado3 == "on") {
            # code...
            $estudio->certificado3 = true;
        } else {
            # code...
            $estudio->certificado3 = false;
        }
        // dd($estudio);
        $estudio->save();
        Alert::success('Estudios creados correctamente', 'Siga agregando información al empleado');
        return redirect()->route('empleados.estudios.index',['empleado'=>$empleado,'estudio'=>$estudio]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoEstudio  $empleadoEstudio
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoEstudio  $empleadoEstudio
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado, $estudio)
    {
        $estudio = $empleado->estudio;
        $edit = true;
        return view('empleado.estudio.create',['empleado'=>$empleado,'estudio'=>$estudio,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoEstudio  $empleadoEstudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado, $estudio)
    {
        $estudio = EmpleadoEstudio::findOrFail($estudio);
        $estudio->escolaridad1 = $request->escolaridad1;
        $estudio->institucion1 = $request->institucion1;
        $estudio->cedula1 = $request->cedula1;
        $estudio->escolaridad2 = $request->escolaridad2;
        $estudio->institucion2 = $request->institucion2;
        $estudio->cedula2 = $request->cedula2;
        $estudio->idioma1 = $request->idioma1;
        $estudio->nivel1 = $request->nivel1;
        $estudio->idioma2 = $request->idioma2;
        $estudio->nivel2 = $request->nivel2;
        $estudio->idioma3 = $request->idioma3;
        $estudio->nivel3 = $request->nivel3;
        $estudio->curso1 = $request->curso1;
        if ($request->certificado1 == "on") {
            # code...
            $estudio->certificado1 = true;
        }
        else {
            $estudio->certificado1 = false;   
        }
        $estudio->curso2 = $request->curso2;
        if ($request->certificado2 == "on") {
            # code...
            $estudio->certificado2 = true;
        } else {
            # code...
            $estudio->certificado2 = false;
        }
        $estudio->curso3 = $request->curso3;
        if ($request->certificado3 == "on") {
            # code...
            $estudio->certificado3 = true;
        } else {
            # code...
            $estudio->certificado3 = false;
        }
        // dd($estudio);
        $estudio->save();

        Alert::success('Estudios actualizados correctamente');
        return redirect()->route('empleados.estudios.index',['empleado'=>$empleado,'estudio'=>$estudio]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoEstudio  $empleadoEstudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoEstudio $empleadoEstudio)
    {
        //
    }
}
