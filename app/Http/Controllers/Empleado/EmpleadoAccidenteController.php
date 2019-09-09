<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoAccidente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoAccidenteController extends Controller
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

        $accidentes = $empleado->accidentes()->orderBy('created_at','desc')->get();
        return view('empleado.accidentes.index',['empleado'=>$empleado,'accidentes'=>$accidentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $empleado = Empleado::withTrashed()->find($id);

        $accidente = new EmpleadoAccidente;
        $edit = false;
        return view('empleado.accidentes.create',['empleado'=>$empleado,'accidente'=>$accidente,'edit'=>$edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $empleado = Empleado::withTrashed()->find($id);

         $accidente = new EmpleadoAccidente($request->all());
        $empleado->accidentes()->save($accidente);
        Alert::success('Registro guardado');
        return redirect()->route('empleados.accidentes.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoAccidente  $empleadoAccidente
     * @return \Illuminate\Http\Response
     */
    public function show(EmpleadoAccidente $empleadoAccidente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoAccidente  $empleadoAccidente
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado,EmpleadoAccidente $empleadoAccidente)
    {
        $edit= true;
        return view('empleado.accidentes.create',['empleado'=>$empleado,'accidente'=>$accidente,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoAccidente  $empleadoAccidente
     * @return \Illuminate\Http\Response
     */
    public function update(Empleado $empleado,Request $request, EmpleadoAccidente $empleadoAccidente)
    {
        $accidente->update($request->all());
        Alert::success('Registro actualizado');
        return redirect()->route('empleados.accidentes.index',['empleado'=>$empleado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoAccidente  $empleadoAccidente
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoAccidente $empleadoAccidente)
    {
        //
    }
}
