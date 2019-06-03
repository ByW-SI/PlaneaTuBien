<?php

namespace App\Http\Controllers\Grupo;

use App\Grupo;
use App\Contrato;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grupos = Grupo::orderBy('fecha_inicio','asc')->get();
        return view('grupo.index',['grupos'=>$grupos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $grupo = new Grupo();
        return view('grupo.form',['grupo'=>$grupo,'edit'=>false]);
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
        $rules = [
            'fecha_inicio'=>"required|date",
            'vigencia'=>'required|integer',
            'fecha_fin'=>'required|date|after:fecha_inicio',
            'contratos'=>"required|integer"
        ];
        $this->validate($request,$rules);
        $grupo = Grupo::create($request->all());
        return redirect()->route('grupos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
        return view('grupo.show',['grupo'=>$grupo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        //
    }

    public function listContratos(Grupo $grupo)
    {
        $contratos = Contrato::where('grupo_id', $grupo->id)->paginate(5);
        return view('grupo.list_contratos',['grupo'=>$grupo, 'contratos' => $contratos]);
    }
}
