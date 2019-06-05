<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud\Contrato;

use App\Domiciliacion;
use App\Http\Controllers\Controller;
use App\Contrato;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class DomiciliacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contrato $contrato)
    {
        //
        // $contrato = $contrato->contrato;
        // dd($contrato);
        if (isset($contrato)) {
            // dd($contrato->domiciliacion);
            if ($contrato->domiciliacion) {
                $domiciliacion=$contrato->domiciliacion;
                $plan=$contrato->presolicitud->cotizacion()->plan;
                return view('domiciliacion.index',['contrato'=>$contrato,'domiciliacion'=>$domiciliacion,'plan'=>$plan]);
            }
            else{
                return redirect()->route('contratos.domiciliacion.create',['contrato'=>$contrato]);
            }
        }
        else {
            // dd('no');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Contrato $contrato)
    {
        //
        return view('domiciliacion.form',['contrato'=>$contrato,'edit'=>false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Contrato $contrato, Request $request)
    {
        //
        $rules=[
            'emisor'=>'required|string',
            'referencia'=>'nullable|string',
            'titular'=>'required|string',
            'banco'=>'required|string',
            'tipo'=>'required|in:CLABE,Tarjeta de crédito/débito',
            'numero'=>'required|numeric'
        ];

        $this->validate($request, $rules);
        $formato = new Domiciliacion($request->all());
        // dd($contrato);
        $formato->contrato_id = $contrato->id;
        $formato->save();
        return redirect()->route('contratos.domiciliacion.index',['contrato'=>$contrato]);
        // dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato, Domiciliacion $domiciliacion)
    {
        //
        $plan=$contrato->presolicitud->cotizacion()->plan;
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.domiciliacion_pdf',['domiciliacion'=>$domiciliacion,'plan'=>$plan,'contrato'=>$contrato])->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('domiciliacion_contrato'.$contrato->numero_contrato.".pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato, Domiciliacion $domiciliacion)
    {
        //
        return view('domiciliacion.form',['contrato'=>$contrato,'edit'=>true,'domiciliacion'=>$domiciliacion]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function update(Contrato $contrato, Request $request, Domiciliacion $domiciliacion)
    {
        //
        $rules=[
            'emisor'=>'required|string',
            'referencia'=>'nullable|string',
            'titular'=>'required|string',
            'banco'=>'required|string',
            'tipo'=>'required|in:CLABE,Tarjeta de crédito/débito',
            'numero'=>'required|numeric'
        ];

        $this->validate($request, $rules);
        $domiciliacion->update($request->all());
        return redirect()->route('contratos.domiciliacion.index',['contrato'=>$contrato]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato, Domiciliacion $domiciliacion)
    {
        //
    }
}
