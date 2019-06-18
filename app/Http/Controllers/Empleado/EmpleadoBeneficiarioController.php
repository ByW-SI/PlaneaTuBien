<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoBeneficiario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoBeneficiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        $beneficiario = $empleado->beneficiario;
        // dd($beneficiario);
        if ($beneficiario) {
            return view('empleado.beneficiario.view',['empleado'=>$empleado,'beneficiario'=>$beneficiario]);
        } else {
            return redirect()->route('empleados.beneficiario.create',['empleado'=>$empleado]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        $beneficiario = new EmpleadoBeneficiario;
        return view('empleado.beneficiario.form',['empleado'=>$empleado,'beneficiario'=>$beneficiario,'edit'=>false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Empleado $empleado, Request $request)
    {
        $beneficiario = new EmpleadoBeneficiario($request->all());
        $empleado->beneficiario()->save($beneficiario);
        Alert::success('Beneficiario creado correctamente', 'Siga agregando información al empleado');
        return redirect()->route('empleados.beneficiario.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoBeneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado, EmpleadoBeneficiario $beneficiario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoBeneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado, EmpleadoBeneficiario $beneficiario)
    {
        return view('empleado.beneficiario.form',['empleado'=>$empleado,'beneficiario'=>$beneficiario,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoBeneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado,  EmpleadoBeneficiario $beneficiario)
    {
        $beneficiario->update($request->all());
        Alert::success('Beneficiario actualizado correctamente', 'Siga agregando información al empleado');
        return redirect()->route('empleados.beneficiario.index',['empleado'=>$empleado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoBeneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoBeneficiario $beneficiario)
    {
        //
    }
}
