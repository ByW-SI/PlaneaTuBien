<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::get();
        return view('empleado.index', ['empleados'=>$empleados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::get();
        return view('empleado.create', ['sucursales' => $sucursales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = Empleado::create($request->all());
        if(!empty($request->input('gerente'))){
            $empleado->id_jefe = $request->input('gerente');
            $empleado->save();
        }
        if(!empty($request->input('supervisor'))){
            $empleado->id_jefe = $request->input('supervisor');
            $empleado->save();
        }
        return redirect()->route('empleados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        return view('empleado.empleadocontacto.index', ['contactos'=>$empleado->contactos, 'empleado'=>$empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        return view('empleado.edit', ['empleado'=>$empleado]);  
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
        $emplaedo->update($request->all());
        return redirect()->route('empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index');
    }

    public function buscarGerentes(){
        $gerentes = Empleado::where('tipo', 'Gerente')->get();
        return view('empleado.listaempleado', ['empleados' => $gerentes]);
    }

    public function buscarSupervisores(){
        $supervisores = Empleado::where('tipo', 'Supervisor')->get();
        return view('empleado.listaempleado', ['empleados' => $supervisores]);
    }

    public function getAsesores(Request $request) {
        $query = $request->input('query');
        $wordsquery = explode(' ', $query);
        $asesores = Empleado::where(function($q) use($wordsquery) {
            foreach ($wordsquery as $word) {
                $q->orWhere('nombre', 'LIKE', "%$word%")
                  ->orWhere('paterno', 'LIKE', "%$word%")
                  ->orWhere('materno', 'LIKE', "%$word%");
            }
        });
        $asesores = $asesores->where('tipo', 'Asesor')->get();
        return view('empleado.asesores', ['asesores' => $asesores]);
    }


}
