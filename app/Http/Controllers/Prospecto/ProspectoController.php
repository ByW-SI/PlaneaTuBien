<?php

namespace App\Http\Controllers\Prospecto;

use App\Prospecto;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prospectos = Prospecto::get();
        return view('prospectos.index', ['prospectos' => $prospectos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asesores = Empleado::where('tipo', 'Asesor')->get();
        return view('prospectos.create', ['asesores' => $asesores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prospecto = Prospecto::create($request->all());
        return redirect()->route('prospectos.show', ['prospecto' => $prospecto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto)
    {
        return view('prospectos.view', ['prospecto' => $prospecto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto)
    {
        $asesores = Empleado::where('tipo', 'Asesor')->get();
        return view('prospectos.edit', ['prospecto' => $prospecto, 'asesores' => $asesores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto)
    {
        // dd($request->all());
        $prospecto->update($request->all());
        return redirect()->route('prospectos.show', ['prospecto' => $prospecto]);
    }

}
