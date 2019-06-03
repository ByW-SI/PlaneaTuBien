<?php

namespace App\Http\Controllers\Pagos;

use App\PagoInscripcion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagoInscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = PagoInscripcion::get();
        return view('pagos.index', ['pagos' => $pagos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PagoInscripcion $pago)
    {
        //
        return view('pagos.show',['pago'=>$pago]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changeStatus(PagoInscripcion $pago, Request $request)
    {
        //
        // dd($pago);
         $rules = [
            'status'=>'required|in:registrado,aprobado,rechazado',
        ];
        $this->validate($request,$rules);
        $pago->update([
            'status'=>$request->status
        ]);
        if ($pago->status == "aprobado") {
            $cotizacion = $pago->cotizacion;
            $cotizacion->liberar = 1;
            $cotizacion->save();
        }
        return back();
    }
    public function formReciboProvisional(PagoInscripcion $pago)
    {
        
    }
    public function submitReciboProvisional(Request $request, PagoInscripcion $pago)
    {
        
    }
}
