<?php

namespace App\Http\Controllers\Precargas;

use App\TipoArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoAreaController extends Controller
{

    public function __construct()
    {
        $this->titulo="Área";
        $this->index='areas.index';
        $this->agregar='areas.create';
        $this->guardar ="areas.store";
        $this->editar="areas.edit";
        $this->actualizar="areas.update";
        $this->borrar="areas.destroy";
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
            $areas = TipoArea::where('nombre', 'LIKE',"%$request->buscar%")->orderBy('nombre','asc')->paginate(10);
        }
        else{
            $areas = TipoArea::orderBy('nombre','asc')->paginate(10);
        }
        return view('precargas.index',['precargas'=>$areas,'index'=>$this->index, 'agregar'=>$this->agregar, 'editar'=>$this->editar,'borrar'=>$this->borrar,'titulo'=>$this->titulo,'buscar'=>$request->buscar]);
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
        $precarga = new TipoArea;
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
        TipoArea::create($request->all());
        return redirect()->route('areas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoArea  $area
     * @return \Illuminate\Http\Response
     */
    public function show(TipoArea $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoArea  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoArea $area)
    {
        //
        return view('precargas.form',['precarga'=>$area, 'titulo'=>$this->titulo, 'edit'=>true,'edit'=>$this->actualizar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoArea  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoArea $area)
    {
        //
        $area->update($request->all());
        return redirect()->route('areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoArea  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoArea $area)
    {
        //
        $area->delete();
        return redirect()->route('areas.index');
    }
}
