<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Contrato;
use App\Pagos;
use App\Mensualidad;
use App\Mail\FichaPagoEfectivoEmail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion = $cliente->cotizacion();
        $plan = $cotizacion->plan;
        $date = Carbon::now();

        //dd($request->all());
        for ($i = 0; $i < count($request->monto_pagar); $i++) {

            $contrato = $cliente->contratos()->where('id', $request->contratos[$i])->first();
            $pago = Pagos::create([
                'contrato_id' => $contrato->id,
                'monto' => $request->monto_pagar[$i],
                'fecha_pago' => $date->toDateString(),
                'status_id' => 1,
                'tipopago_id' => 1,
                'referencia' => $request->input('referencia')[$i],
                'mensualidad_id' => $contrato->mensualidades->last()->id
            ]);
        }
        return redirect()->route('cliente.dashboard')->with('status', "<h3>!Compleatdo</h3>Se realizo con exito tu pago.");
    }

    /**
     * Almacena todos los pagos por cada una de las referencias
     * recibidas, y almacena la imagen de comprobante en la carpeta
     * "public/contratos" con el id del pago
     */

    public function storePagosEfectivos(Request $request)
    {
        //dd($request->all());
        $total_referencias = count($request->input('referencia'));

        for ($i = 0; $i < $total_referencias; $i++) {

            $pago = $this->storePagoEfectivo($request, $i);
            $file = $request->file('file_comprobante')[$i];
            $this->storeComprobanteImg($file, $pago);
        }
        return redirect()->route('cliente.dashboard')->with('status', "Pago registrado correctamente, espera a que se valide");
    }

    /**
     * Almacena el pago en efectivo con el índice de la referencia
     * recibida.
     */

    public function storePagoEfectivo(Request $request, $i)
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $cotizacion = $cliente->cotizacion();
        $plan = $cotizacion->plan;
        $monto_pago = $request->monto[$i];
<<<<<<< HEAD
        $contrato = Contrato::where('numero_contrato',substr($request->input('contrato')[$i], 3))->first();
=======
        $contrato = Contrato::where('numero_contrato', $request->input('contrato')[$i])->first();
>>>>>>> 059d128e6ebc7c9d16b60f894343e7bb661c93c4

        $mensual_adeudos = [];
        foreach($contrato->mensualidades()->get() as $mensualidad){
            if(!$mensualidad->pagado)
                $mensual_adeudos[] = $mensualidad;
        }

        $total = 0;
        foreach ($mensual_adeudos as $mensual) {
            $cantidad_pagada = 0;
            foreach ($mensual->pagos()->aprobados()->get() as $pago) {
                if ($pago) 
                    $cantidad_pagada += $pago->monto;
            }
            $total += ($mensual->cantidad + $mensual->recargo) - $cantidad_pagada;
        }
        $monto_pagar = $total;
        /*
        * bccomp devuelve 
        * 0 si son igual
        * 1 si el de la izquierda es mayor que el de la derecha
        * -1 de lo contrario
        */
        $pago = Pagos::create([
            'contrato_id' => $contrato->id,
            'monto' => $monto_pago,
            'fecha_pago' => $request->input('fecha_pago')[$i],
            'folio' => $request->input('folio')[$i],
            'status_id' => 2,
            'tipopago_id' => 2,
            'referencia' => $request->input('referencia')[$i],
            'spei' => $request->input('spei')[$i],
            'mensualidad_id' => $contrato->mensualidades->last()->id
        ]);
        
        return $pago;
    }

    /**
     * Almacena la imagen del comprobante de pago en la carpeta
     * "public/img/comprobantes/" con el id del pago almacenado
     */

    public function storeComprobanteImg($file, Pagos $pago)
    {
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $filename = $pago->id . '.' . $extension;
            $file->move('contratos/', $filename);
            $pago->update(['file_comprobante' => $filename]);
        }
    }

    /** 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function isValidFechaPago($fecha)
    {
        $start = new Carbon('first day of this month');
        $end = $start->addDay(6);

        while ($end->englishDayOfWeek === "Saturday" || $end->englishDayOfWeek === "Sunday") {
            /*
            Aqui ira la condicion de la precarga de dias feriados
            */
            $end->addDay();
        }
        if ($start->lessThanOrEqualTo($fecha) && $end->greaterThanOrEqualTo($fecha))
            return true;
        else
            return false;
    }

    public function generacionHojaPagoEfectivo(Request $request)
    {
        if ($request->opcion === "imprimir") {
            return $this->generarPDFFichaPagoEfectivo($request);
        }
        else{
            $this->enviarMailFichaPagoEfectivo($request);
            return redirect()->route('cliente.dashboard')->with('status', "Correo enviado con exito.");
        }
    }

    public function generarPDFFichaPagoEfectivo(Request $request)
    {
        //dd($request->all());
        $cliente = auth('cliente')->user()->presolicitud;
        $data = [];
        for ($i=0; $i < count($request->ref); $i++) { 
            $data[] = ['referencia'=>$request->ref[$i], 'monto'=>$request->monto[$i], 'num_contrato'=>$request->num_contrato[$i]];
        }
        $pdf = PDF::loadView('cliente.efectivo.pagoEfectivo',['data'=>$data,]);
        //return $pdf->stream();
        if ($request->opcion == "imprimir") {
            return $pdf->download('pago_efectivo'.$cliente->nombre.$cliente->paterno.$cliente->materno.".pdf");
        }
        else
            return $pdf;
    }

    public function enviarMailFichaPagoEfectivo(Request $request)
    {
        $cliente = auth('cliente')->user()->presolicitud;
        $pdf = $this->generarPDFFichaPagoEfectivo($request);
        Mail::to($request->correodestino)->send(new FichaPagoEfectivoEmail($pdf, $cliente));
    }
}
