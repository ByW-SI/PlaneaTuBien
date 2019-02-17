<?php

namespace App\Http\Controllers\Prospecto;

use App\Empleado;
use App\Events\ProspectoCreated;
use App\Http\Controllers\Controller;
use App\Prospecto;
use Illuminate\Http\Request;

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
        $asesores = Empleado::where('cargo', 'Asesor')->get();
        return view('prospectos.create', ['asesores' => $asesores]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formprospecto(Request $request)
    {
        // dd($request->alert->status);
        return view('prospectos.formprospecto',['alert'=>$request->alert]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitprospecto(Request $request){
        $rules = [
            'nombre'=>'required|max:191',
            'appaterno'=>'required|max:191',
            'apmaterno'=>'nullable|max:191',
            'sexo'=>'nullable|in:["","Hombre","Mujer"]',
            'email'=>"required|e-mail",
            'tel'=>"required|numeric",
            'movil'=>"nullable|numeric",
            'monto'=>"required|numeric",
            'plan'=>'required'
        ];
        // dd($this->validate($request,$rules));
        $prospecto = Prospecto::create($request->all());
        event(new ProspectoCreated($prospecto));
        return redirect()->route('prospecto.create',['alert'=>['status'=>"success",'message'=>"Muy pronto un asesor se comunicará contigo"]]);
        // dd($request->all());
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
        $asesores = Empleado::where('cargo', 'Asesor')->get();
        return view('prospectos.edit', ['prospecto' => $prospecto, 'asesores' => $asesores]);
    }

    public function asignarAsesor(Prospecto $prospecto)
    {
        // dd($prospecto);
        $asesores = Empleado::where('cargo', 'Asesor')->get();
        return view('prospectos.asesor.form',['prospecto'=>$prospecto,'asesores'=>$asesores]);
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
