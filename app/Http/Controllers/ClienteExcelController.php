<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clienteexcel');
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
        /*
        Las tablas a llenar son las de 
        * prospectos  -> primeros datos del cliente
        * presolicitud -> datos del cliente de acuerdo a lo que pidio
        * pago_inscripcions ->el pago de la incsripcion de acuerdo a la cotizacion (se tendria que quedar sin cotizacion)
        * perfil_datos_personal_clientes -> datos redundantes del prospectos ya cuando se tiene su pago de inscripcion
        * perfil_historial_crediticio_clientes -> datos crediticios del cliente (creo que estos no vienen en el excel)
        * perfil_inmueble_pretendido_cleintes -> datos del inmueble que pretende comprar (creo que no vienen en el excel)
        * perfil_referencia_personal_clientes -> datos de las referencias del cliente estas si vienen 
        */
        if ($request->hasFile('excel_file')) {

            $clientes = \Excel::toArray(null, request()->file('excel_file'))[0];
            dd($clientes);
            foreach ($clientes as $registro) {
                //
            }
        }
        return "Fallo";
        //return redirect()->route('excelpagos')->with('status', "Se cargo correctamente el archivo.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
