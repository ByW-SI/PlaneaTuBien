<?php

namespace App\Http\Controllers\Prospecto\Cotizacion;

use App\Cotizacion;
use App\Http\Controllers\Controller;
use App\Prospecto;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto, Cotizacion $cotizacion)
    {
        //

        return view('prospectos.perfil.form',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion]);
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

}
