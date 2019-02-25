<?php

namespace App\Http\Controllers\Empleado;

use App\Cotizacion;
use App\Empleado;
use App\Http\Controllers\Controller;
use App\Promocion;
use App\Prospecto;
use Illuminate\Http\Request;

class EmpleadoProspectoCotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado,Prospecto $prospecto)
    {
        return view('empleado.prospecto.cotizacion.index', ['empleado'=>$empleado, 'prospecto' => $prospecto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado,Prospecto $prospecto)
    {
        $promociones = Promocion::orderBy('valido_inicio','desc')->get();
        return view('empleado.prospecto.cotizacion.create', ['empleado'=>$empleado,'prospecto' => $prospecto,'promociones'=>$promociones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Empleado $empleado,Prospecto $prospecto, Request $request)
    {
        $cotizacion = new Cotizacion($request->all());
        $promocion = Promocion::find($request->promocion);
        $prospecto->cotizaciones()->save($cotizacion);
        $cotizacion->promocion()->associate($promocion);
        $cotizacion->save();
        return redirect()->route('empleados.prospectos.cotizacions.index', ['empleado'=>$empleado,'prospecto' => $prospecto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado,Prospecto $prospecto, Cotizacion $cotizacion)
    {
        return view('empleado.prospecto.cotizacion.view', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Empleado $empleado,Request $request, Cotizacion $cotizacion)
    {
        //
    }

    public function pdf(Empleado $empleado, Prospecto $prospecto, Cotizacion $cotizacion) {
        $date = date('d-m-Y');
        $pdf = PDF::loadView('empleado.prospecto.cotizacion.pdf', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
        return $pdf->download('cotizacion' . $date . '.pdf');
    }
}
