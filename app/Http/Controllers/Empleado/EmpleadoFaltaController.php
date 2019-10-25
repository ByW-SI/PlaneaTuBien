<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\EmpleadoFalta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoFaltaController extends Controller
{

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                foreach (Auth::user()->perfil->componentes as $componente)
                    if($componente->modulo->nombre == "rh")
                        return $next($request);
                return redirect()->route('denegado');
            } else
                return redirect()->route('login');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $empleado = Empleado::withTrashed()->find($id);
        $faltas = $empleado->faltas;
        
        $meses = array(
            "01" => "enero",
            "02" => "febrero",
            "03" => "marzo",
            "04" => "abril",
            "05" => "mayo",
            "06" => "junio",
            "07" => "enero",
            "08" => "febrero",
            "09" => "marzo",
            "10" => "octubre",
            "11" => "mayo",
            "12" => "junio"
        );

        $mes_actual = $meses[date('m')];

        return view('empleado.falta.view',['empleado'=>$empleado,'faltas'=>$faltas, 'mes_actual' => $mes_actual]);
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
    public function store(Request $request, $id)
    {

        // dd($request->input());

        $empleado = Empleado::withTrashed()->find($id);


        $falta = new EmpleadoFalta($request->all());
        $empleado->faltas()->save($falta);

        $total_retardos_este_mes = count($empleado->faltas()->where('tipofalta', 'like', '%retardo%')->whereMonth('fecha', date('m'))->get());
        $num_faltas_por_retardos_que_deberia = intdiv( $total_retardos_este_mes, 3 );
        $num_faltas_por_retardos_que_tiene = count($empleado->faltas()->where('tipofalta', 'falta por retardos')->whereMonth('fecha', date('m'))->get());

        // dd($num_faltas_por_retardos_que_tiene);
        if( $num_faltas_por_retardos_que_tiene < $num_faltas_por_retardos_que_deberia ){
            // dd( $num_faltas_por_retardos_que_tiene . '<' . $num_faltas_por_retardos_que_deberia );
            EmpleadoFalta::create([
                'empleado_id' => $empleado->id,
                'fecha' => $request->fecha,
                'tipofalta' => 'falta por retardos',
                'motivo' => 'Retardos acumulados'
            ]);

        }

        Alert::success('Información Agregada', 'Se ha registrado correctamente la información');
        return redirect()->route('empleados.faltas.index',['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoFalta  $empleadoFalta
     * @return \Illuminate\Http\Response
     */
    public function show(EmpleadoFalta $empleadoFalta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoFalta  $empleadoFalta
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleadoFalta $empleadoFalta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoFalta  $empleadoFalta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoFalta $empleadoFalta)
    {
    }

    public function actualizar(Request $request)
    {
        $falta = EmpleadoFalta::find( $request->falta_id );
        // dd($falta);

        $falta->update($request->all());
        
        return redirect()->back()->with('status','¡La falta ha sido actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoFalta  $empleadoFalta
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoFalta $empleadoFalta)
    {
        //
    }
}
