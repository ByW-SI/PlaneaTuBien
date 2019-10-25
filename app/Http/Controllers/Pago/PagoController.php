<?php

namespace App\Http\Controllers\Pago;

use App\Prospecto;
use App\Pagos;
use App\PagoInscripcion;
use App\Banco;
use App\Events\PagoCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto)
    {
        return view('prospectos.pagos.index', ['prospecto' => $prospecto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto)
    {
        $bancos = Banco::get();
        return view('prospectos.pagos.create', ['prospecto' => $prospecto, 'bancos' => $bancos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Request $request)
    {
        $pago = new Pago($request->all());
        $prospecto->pagos()->save($pago);
        event(new PagoCreated($prospecto, $pago));
        return redirect()->route('prospectos.pagos.index', ['prospecto' => $prospecto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto, Pago $pago)
    {
        return view('prospectos.pagos.view', ['prospecto' => $prospecto, 'pago' => $pago]);
    }

    public function follow(Prospecto $prospecto, Pago $pago) {
        $bancos = Banco::get();
        return view('prospectos.pagos.follow', ['prospecto' => $prospecto, 'bancos' => $bancos, 'pago' => $pago]);
    }

    public function aprobar(Request $request, $id){
        
        $pago_inscripcion = PagoInscripcion::find($id);
        $pago_inscripcion->update([
            'status'=>'aprobado'
        ]);
        // dd($pago_inscripcion);

        return redirect()->back();

    }
    
}
