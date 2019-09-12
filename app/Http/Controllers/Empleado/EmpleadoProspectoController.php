<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Http\Controllers\Controller;
use App\Prospecto;
use Illuminate\Http\Request;

class EmpleadoProspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado, Request $request)
    {
        // if ($request->buscar) {
        //     $wordsquery = explode(" ",$request->buscar);
        //     $prospectos=$empleado->prospectos()
        //                 ->where(function ($query)use ($wordsquery)
        //                 {
        //                     foreach ($wordsquery as $word) {
        //                         $query = $query->orWhere('nombre', 'like', "%{$word}%")
        //                                         ->orWhere('appaterno', 'like', "%{$word}%")
        //                                         ->orWhere('apmaterno', 'like', "%{$word}%");
        //                     }
        //                     $query->where('aprobado',1)
        //                         ->orWhereNull('aprobado');
        //                 })->get();   
        // }
        // else{
        //     $prospectos=$empleado->prospectos()
        //                 ->where(function ($query)
        //                 {
        //                     $query->where('aprobado',1)
        //                         ->orWhereNull('aprobado');
        //                 })->get();       
        // }
        // dd($prospectos);

        $prospectos = $empleado->prospectos()->get();
        // dd($prospectos);

        return view('empleado.prospecto.index', ['empleado' => $empleado, 'prospectos' => $prospectos, 'buscar' => $request->buscar]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado, Prospecto $prospecto)
    {
        if (isset($prospecto->aprobado)) {
            return view('empleado.prospecto.show', ['empleado' => $empleado, 'prospecto' => $prospecto]);
        } else {
            return redirect()->route('empleados.prospectos.edit', ['prospecto' => $prospecto, 'empleado' => $empleado]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado, Prospecto $prospecto)
    {
        //
        return view('empleado.prospecto.form', ['empleado' => $empleado, 'prospecto' => $prospecto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function update(Empleado $empleado, Request $request, Prospecto $prospecto)
    {
        //
        $rules = [
            'nombre' => 'required|max:191',
            'appaterno' => 'required|max:191',
            'apmaterno' => 'nullable|max:191',
            'sexo' => 'nullable|in:,Hombre,Mujer',
            'email' => "required|e-mail",
            'tel' => "nullable|numeric",
            'movil' => "nullable|numeric",
            'sueldo' => 'required|numeric',
            'ahorro' => 'required|numeric',
            'calificacion' => 'required|numeric',
            'aprobado' => 'required|boolean',
            'monto' => 'required|numeric',
            'gastos' => 'required|numeric',
            'plan' => ' required|in:15 años,10 años,6 años,5 años,3 años',
        ];
        $this->validate($request, $rules);
        $prospecto->update($request->all());
        $prospecto->sueldo = $request->sueldo;
        $prospecto->ahorro = $request->ahorro;
        $prospecto->gastos = $request->gastos;
        $prospecto->calificacion = $request->calificacion;
        $prospecto->aprobado = $request->aprobado;
        $prospecto->monto = $request->monto;
        $prospecto->plan = $request->plan;
        $prospecto->save();
        return redirect()->route('empleados.prospectos.show', ['prospecto' => $prospecto, 'empleado' => $empleado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado, Prospecto $prospecto)
    {
        //
    }
}
