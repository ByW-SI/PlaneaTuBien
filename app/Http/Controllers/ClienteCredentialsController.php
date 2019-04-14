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
            // dd('Si hay cliente');
            return view('cliente.index',['cliente'=>$cliente]);
        } else {
            return view('cliente.index');
            // dd('No hay cliente');
            return redirect()->route('clientes.create');

        }
    }
}