<?php

namespace App\Http\Controllers\Sucursal;

use App\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SucursalController extends Controller
{

    /**
     * Configura los middleware para cada accion del controlador.
     *
     * @return 
     */
    function __construct()
    {
        $this->middleware('empleados:indice Sucursales')->only('index');
        $this->middleware('empleados:crear sucursal')->only(['create', 'store']);
        $this->middleware('empleados:editar sucursal')->only(['edit', 'update']);
        $this->middleware('empleados:ver sucursal')->only('show');
        $this->middleware('empleados:eliminar sucursal')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::get();
        return view('sucursales.index', ['sucursales' => $sucursales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucursal = Sucursal::create($request->all());
        return redirect()->route('sucursals.show', ['sucursal' => $sucursal]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        return view('sucursales.view', ['sucursal' => $sucursal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        return view('sucursales.edit', ['sucursal' => $sucursal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $sucursal->update($request->all());
        return redirect()->route('sucursals.show', ['sucursal' => $sucursal]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();
        return redirect()->route('sucursals.index');
    }

    public function sucursalesAjax(){
        $sucursales = Sucursal::get();
        return view('sucursales.lista', ['sucursales'=>$sucursales]);
    }
}
