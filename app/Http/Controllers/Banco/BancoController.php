<?php

namespace App\Http\Controllers\Banco;

use App\Banco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BancoController extends Controller
{

    public function __construct()
    {
        $this->titulo="Bancos";
        $this->index='bancos.index';
        $this->agregar='bancos.create';
        $this->guardar ="bancos.store";
        $this->editar="bancos.edit";
        $this->actualizar="bancos.update";
        $this->borrar="bancos.destroy";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $bancos = Banco::get();
        // return view('precargas.bancos.index', ['bancos' => $bancos]);


        $bancos = Banco::orderBy('nombre','asc')->paginate(10);
        return view('precargas.index',['precargas'=>$bancos,'index'=>$this->index, 'agregar'=>$this->agregar, 'editar'=>$this->editar,'borrar'=>$this->borrar,'titulo'=>$this->titulo,'buscar'=>null]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('precargas.bancos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banco = Banco::create($request->all());
        return redirect()->route('bancos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
        return view('precargas.form',['precarga'=>$banco, 'titulo'=>$this->titulo, 'edit'=>true,'edit'=>$this->actualizar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banco $banco)
    {
        $banco->update($request->all());
        return redirect()->route('bancos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banco $banco)
    {
        $banco->delete();
        return redirect()->back();
    }
}
