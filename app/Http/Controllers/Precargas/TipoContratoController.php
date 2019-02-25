<?php

namespace App\Http\Controllers\Precargas;

use App\TipoContrato;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoContratoController extends Controller
{
    public function __construct()
    {
        $this->titulo="Contrato";
        $this->index='contratos.index';
        $this->agregar='contratos.create';
        $this->guardar ="contratos.store";
        $this->editar="contratos.edit";
        $this->actualizar="contratos.update";
        $this->borrar="contratos.destroy";
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
            $contratos = TipoContrato::where('nombre', 'LIKE',"%$request->buscar%")->orderBy('nombre','asc')->paginate(10);
        }
        else{
            $contratos = TipoContrato::orderBy('nombre','asc')->paginate(10);
        }
        return view('precargas.index',['precargas'=>$contratos,'index'=>$this->index, 'agregar'=>$this->agregar, 'editar'=>$this->editar,'borrar'=>$this->borrar,'titulo'=>$this->titulo,'buscar'=>$request->buscar]);
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
        $precarga = new TipoContrato;
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
        TipoContrato::create($request->all());
        return redirect()->route('contratos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoContrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(TipoContrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoContrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoContrato $contrato)
    {
        //
        return view('precargas.form',['precarga'=>$contrato, 'titulo'=>$this->titulo, 'edit'=>true,'edit'=>$this->actualizar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoContrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoContrato $contrato)
    {
        //
        $contrato->update($request->all());
        return redirect()->route('contratos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoContrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoContrato $contrato)
    {
        //
        $contrato->delete();
        return redirect()->route('contratos.index');
    }
}
