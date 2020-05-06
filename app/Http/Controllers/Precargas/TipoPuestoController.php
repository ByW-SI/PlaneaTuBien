<?php

namespace App\Http\Controllers\Precargas;

use App\TipoPuesto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoPuestoController extends Controller
{
    public function __construct()
    {
        $this->titulo="Puesto";
        $this->index='puestos.index';
        $this->agregar='puestos.create';
        $this->guardar ="puestos.store";
        $this->editar="puestos.edit";
        $this->actualizar="puestos.update";
        $this->borrar="puestos.destroy";
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
            $puestos = TipoPuesto::where('nombre', 'LIKE',"%$request->buscar%")->orderBy('nombre','asc')->paginate(10);
        }
        else{
            $puestos = TipoPuesto::orderBy('nombre','asc')->paginate(10);
        }
        return view('precargas.index',['precargas'=>$puestos,'index'=>$this->index, 'agregar'=>$this->agregar, 'editar'=>$this->editar,'borrar'=>$this->borrar,'titulo'=>$this->titulo,'buscar'=>$request->buscar]);
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
        $precarga = new TipoPuesto;
        return view('puestos.create',['titulo'=>$this->titulo, 'edit'=>false,'guardar'=>$this->guardar, 'precarga'=>$precarga]);
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
        TipoPuesto::create($request->all());
        return redirect()->route('puestos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoPuesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPuesto $puesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoPuesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPuesto $puesto)
    {
        //
        return view('precargas.form',['precarga'=>$puesto, 'titulo'=>$this->titulo, 'edit'=>true,'edit'=>$this->actualizar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPuesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPuesto $puesto)
    {
        //
        $puesto->update($request->all());
        return redirect()->route('puestos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoPuesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPuesto $puesto)
    {
        //
        $puesto->delete();
        return redirect()->route('puestos.index');
    }
}
