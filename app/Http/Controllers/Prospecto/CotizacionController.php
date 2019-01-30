<?php

namespace App\Http\Controllers\Prospecto;

use App\Prospecto;
use App\Cotizacion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto)
    {
        return view('prospectos.cotizacions.index', ['prospecto' => $prospecto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto)
    {
        return view('prospectos.cotizacions.create', ['prospecto' => $prospecto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Request $request)
    {
        $cotizacion = new Cotizacion($request->all());
        $prospecto->cotizaciones()->save($cotizacion);
        return redirect()->route('prospectos.cotizacions.index', ['prospecto' => $prospecto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto, Cotizacion $cotizacion)
    {
        return view('prospectos.cotizacions.view', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        //
    }

    public function pdf(Prospecto $prospecto, Cotizacion $cotizacion) {
        $date = date('d-m-Y');
        $pdf = PDF::loadView('prospectos.cotizacions.pdf', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
        return $pdf->download('cotizacion' . $date . '.pdf');
    }

}
