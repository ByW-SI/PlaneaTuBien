<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteCredentialsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:cliente');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = auth('cliente')->user()->presolicitud;
        if ($cliente) {
            $cotizacion = $cliente->cotizacion();
            $plan = $cotizacion->plan;
            // dd('Si hay cliente');
            return view('cliente.index',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'plan'=>$plan]);
        } else {
            return view('cliente.index');
            // dd('No hay cliente');
            return redirect()->route('clientes.create');

        }
    }
}