<?php

namespace App\Http\Controllers\Poliza;

use App\Poliza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PolizaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $polizas = Poliza::orderBy('fecha_inicio','asc')->get();
        return view('poliza.index',['polizas'=>$polizas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('poliza.form',['edit'=>false]);
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
        $request->validate([
            'nombre'=>'required|string',
            'descripcion'=>'string|nullable',
            'fecha_inicio'=>'date|required',
            'fecha_fin'=>'date|required|after:fecha_inicio',
            'folio'=>'string|required|alpha_num',
            'nombre_asesor'=>'string|required',
            'tel_contacto'=>'digits_between:8,10|required',
        ]);
        Poliza::create($request->all()); 
        return redirect()->route('polizas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function show(Poliza $poliza)
    {
        //
        return view('poliza.show',['poliza'=>$poliza]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function edit(Poliza $poliza)
    {
        return view('poliza.form',['edit'=>true,'poliza'=>$poliza]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poliza $poliza)
    {
        //
        $request->validate([
            'nombre'=>'required|string',
            'descripcion'=>'string|nullable',
            'fecha_inicio'=>'date|required',
            'fecha_fin'=>'date|required|after:fecha_inicio',
            'folio'=>'string|required|alpha_num',
            'nombre_asesor'=>'string|required',
            'tel_contacto'=>'digits_between:8,10|required',
        ]);
        $poliza->update($request->all());
        return redirect()->route('polizas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poliza  $poliza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poliza $poliza)
    {
        //
        $poliza->delete();
        return redirect()->route('polizas.index');
    }
}
