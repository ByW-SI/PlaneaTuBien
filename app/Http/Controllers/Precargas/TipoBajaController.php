<?php

namespace App\Http\Controllers\Precargas;

use App\TipoBaja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoBajaController extends Controller
{
    public function __construct()
    {
        $this->titulo="Baja";
        $this->index='bajas.index';
        $this->agregar='bajas.create';
        $this->guardar ="bajas.store";
        $this->editar="bajas.edit";
        $this->actualizar="bajas.update";
        $this->borrar="bajas.destroy";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->buscar);
        if($request->buscar){
            $bajas = TipoBaja::where('nombre', 'LIKE',"%$request->buscar%")->orderBy('nombre','asc')->paginate(10);
        }
        else{
            $bajas = TipoBaja::orderBy('nombre','asc')->paginate(10);
        }
        return view('precargas.index',['precargas'=>$bajas,'index'=>$this->index, 'agregar'=>$this->agregar, 'editar'=>$this->editar,'borrar'=>$this->borrar,'titulo'=>$this->titulo,'buscar'=>$request->buscar]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $precarga = new TipoBaja;
        return view('precargas.form',['titulo'=>$this->titulo, 'edit'=>false,'guardar'=>$this->guardar, 'precarga'=>$precarga]);
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
        TipoBaja::create($request->all());
        return redirect()->route('bajas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoBaja  $area
     * @return \Illuminate\Http\Response
     */
    public function show(TipoBaja $baja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoBaja  $baja
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoBaja $baja)
    {
        //
        return view('precargas.form',['precarga'=>$baja, 'titulo'=>$this->titulo, 'edit'=>true,'edit'=>$this->actualizar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoBaja  $baja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoBaja $baja)
    {
        //
        $baja->update($request->all());
        return redirect()->route('bajas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoBaja  $baja
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoBaja $baja)
    {
        //
        $baja->delete();
        return redirect()->route('bajas.index');
    }
}
