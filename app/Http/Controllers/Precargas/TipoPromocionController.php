<?php

namespace App\Http\Controllers\Precargas;

use App\TipoPromocion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoPromocionController extends Controller
{
    public function __construct()
    {
        $this->titulo="Precarga de promociones";
        $this->index='tipo_promocions.index';
        $this->agregar='tipo_promocions.create';
        $this->guardar ="tipo_promocions.store";
        $this->editar="tipo_promocions.edit";
        $this->actualizar="tipo_promocions.update";
        $this->borrar="tipo_promocions.destroy";
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
            $tipo_promocions = TipoPromocion::where('nombre', 'LIKE',"%$request->buscar%")->orderBy('nombre','asc')->paginate(10);
        }
        else{
            $tipo_promocions = TipoPromocion::orderBy('nombre','asc')->paginate(10);
        }
        return view('precargas.index',['precargas'=>$tipo_promocions,'index'=>$this->index, 'agregar'=>$this->agregar, 'editar'=>$this->editar,'borrar'=>$this->borrar,'titulo'=>$this->titulo,'buscar'=>$request->buscar]);
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
        $precarga = new TipoPromocion;
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
        TipoPromocion::create($request->all());
        return redirect()->route('tipo_promocions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoPromocion  $tipo_promocion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPromocion $tipo_promocion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoPromocion  $tipo_promocion
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPromocion $tipo_promocion)
    {
        //
        return view('precargas.form',['precarga'=>$tipo_promocion, 'titulo'=>$this->titulo, 'edit'=>true,'edit'=>$this->actualizar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPromocion  $tipo_promocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPromocion $tipo_promocion)
    {
        //
        $tipo_promocion->update($request->all());
        return redirect()->route('tipo_promocions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoPromocion  $tipo_promocion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPromocion $tipo_promocion)
    {
        //
        $tipo_promocion->delete();
        return redirect()->route('tipo_promocions.index');
    }
}
