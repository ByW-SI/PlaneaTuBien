<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud\Contrato;

use App\Domiciliacion;
use App\Http\Controllers\Controller;
use App\Recibo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class DomiciliacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Recibo $recibo)
    {
        //
        $contrato = $recibo->contrato;
        // dd($contrato);
        if (isset($contrato)) {
            // dd($contrato->domiciliacion);
            if ($contrato->domiciliacion) {
                $domiciliacion=$contrato->domiciliacion;
                $plan=$recibo->presolicitud->cotizacion()->plan;
                return view('domiciliacion.index',['contrato'=>$contrato,'recibo'=>$recibo,'domiciliacion'=>$domiciliacion,'plan'=>$plan]);
            }
            else{
                return redirect()->route('recibos.domiciliacion.create',['recibo'=>$recibo]);
            }
        }
        else {
            dd('no');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Recibo $recibo)
    {
        //
        return view('domiciliacion.form',['recibo'=>$recibo,'edit'=>false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Recibo $recibo, Request $request)
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
        $contrato = $recibo->contrato;
        // dd($contrato);
        $formato->contrato_id = $contrato->id;
        $formato->save();
        return redirect()->route('recibos.domiciliacion.index',['recibo'=>$recibo]);
        // dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo $recibo, Domiciliacion $domiciliacion)
    {
        //
        $plan=$recibo->presolicitud->cotizacion()->plan;
        $pdf = PDF::loadView('prospectos.presolicitud.documentos.domiciliacion_pdf',['domiciliacion'=>$domiciliacion,'plan'=>$plan,'recibo'=>$recibo])->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('domiciliacion_recibo'.$recibo->clave.$recibo->id.".pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo, Domiciliacion $domiciliacion)
    {
        //
        return view('domiciliacion.form',['recibo'=>$recibo,'edit'=>true,'domiciliacion'=>$domiciliacion]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function update(Recibo $recibo, Request $request, Domiciliacion $domiciliacion)
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
        return redirect()->route('recibos.domiciliacion.index',['recibo'=>$recibo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domiciliacion  $domiciliacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo $recibo, Domiciliacion $domiciliacion)
    {
        //
    }
}
