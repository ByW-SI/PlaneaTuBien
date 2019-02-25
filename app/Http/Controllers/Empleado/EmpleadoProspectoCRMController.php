<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Http\Controllers\Controller;
use App\Prospecto;
use App\ProspectoCRM;
use Illuminate\Http\Request;

class EmpleadoProspectoCRMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado,Prospecto $prospecto, Request $request)
    {
        //

        $prospecto = $empleado->prospectos()->findOrFail($prospecto->id);
        $crms = $prospecto->crms()->paginate(5);
        return view('empleado.prospecto.crm.index',['empleado'=>$empleado,'prospecto'=>$prospecto,'crms'=>$crms]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado,Prospecto $prospecto)
    {
        //
        return view('empleado.prospecto.crm.form',['empleado'=>$empleado,'prospecto'=>$prospecto,'edit'=>false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Empleado $empleado,Prospecto $prospecto,Request $request)
    {
        // 
        $crm = new ProspectoCRM($request->all());
        $prospecto->crms()->save($crm);
        return redirect()->route('empleados.prospectos.crms.index',['prospecto'=>$prospecto,'empleado'=>$empleado]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProspectoCRM  $crm
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado,Prospecto $prospecto,ProspectoCRM $crm)
    {
        //
        return view('empleado.prospecto.crm.view',['prospecto'=>$prospecto,'empleado'=>$empleado,'crm'=>$crm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProspectoCRM  $crm
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado,Prospecto $prospecto,ProspectoCRM $crm)
    {
        //
        // return view('empleado.prospecto.crm.view',['prospecto'=>$prospecto,'empleado'=>$empleado,'crm'=>$crm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProspectoCRM  $crm
     * @return \Illuminate\Http\Response
     */
    public function update(Empleado $empleado,Prospecto $prospecto,Request $request, ProspectoCRM $crm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProspectoCRM  $crm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado,Prospecto $prospecto,ProspectoCRM $crm)
    {
        //
    }
}
