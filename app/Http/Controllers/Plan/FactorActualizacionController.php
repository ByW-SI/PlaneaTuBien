<?php

namespace App\Http\Controllers\Plan;

use App\FactorActualizacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FactorActualizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $factores = FactorActualizacion::orderBy('created_at','desc')->get();
        return view('factor_actualizacion.index',['factores'=>$factores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('factor_actualizacion.create');
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
        $request->validate(['porcentaje'=>'required|numeric|between:1,100']);
        FactorActualizacion::create($request->all());
        return redirect()->route('factors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FactorActualizacion  $factorActualizacion
     * @return \Illuminate\Http\Response
     */
    public function show(FactorActualizacion $factorActualizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FactorActualizacion  $factorActualizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(FactorActualizacion $factorActualizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FactorActualizacion  $factorActualizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FactorActualizacion $factor)
    {
        //
        $factor->autorizar = !$factor->autorizar;
        $factor->save();
        return redirect()->route('factors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FactorActualizacion  $factorActualizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(FactorActualizacion $factor)
    {
        //
        $factor->delete();
        return redirect()->route('factors.index');
    }
}
