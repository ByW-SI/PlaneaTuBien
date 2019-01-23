<?php

namespace App\Http\Controllers\Prospecto;

use App\Prospecto;
use App\Documento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto)
    {
        return redirect()->route('prospectos.show', ['prospecto' => $prospecto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto)
    {
        return view('prospectos.documentos.create', ['prospecto' => $prospecto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Request $request)
    {
        $documento = new Documento($request->all());
        $prospecto->documentos()->save($documento);
        return redirect()->route('prospectos.documentos.index', ['prospecto' => $prospecto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto, Documento $documento)
    {
        return view('prospectos.documentos.edit', ['prospecto' => $prospecto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto)
    {
        $prospecto->documentos()->update($request->except(['_token', '_method']));
        return redirect()->route('prospectos.documentos.index', ['prospecto' => $prospecto]);
    }

}
