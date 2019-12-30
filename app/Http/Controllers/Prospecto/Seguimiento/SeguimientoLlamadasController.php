<?php

namespace App\Http\Controllers\Prospecto\Seguimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Prospecto;
use App\ResultadoLlamada;
use App\SeguimientoLlamadas;

class SeguimientoLlamadasController extends Controller
{
    /**
     * Muestra una lista con los prospectos con estatus seguimeinto de llamadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$estatusLlamada = ResultadoLlamada::get();
    	$empleado = Auth::user()->empleado;
        if ($empleado->tipo == 'Admin') {
        	$prospectos = Prospecto::where('estatus_id', '1')->get();
        } else {
        	$prospectos = $empleado->prospectos->where('estatus_id', '1')->get();
        }
        $seguimientoLlamadas = [];

        // Obtenemos los registros de las llamadas de cada prospecto, solo los ultimos 4
        foreach ($prospectos as $key => $value) {
            $aux = [];
            dd($value->asesores->last()->pivot->seguimientoLlamadas);
            $segLlamada = $value->asesores->last()->pivot->seguimientoLlamadas->sortByDesc('id')->take(4);
            dd($segLlamada);
            for ($i=0; $i < 4; $i++) { 
                if(isset($segLlamada[$i])){
                    $aux[] = [
                        $segLlamada->fecha_contacto,
                        $segLlamada->resultadoLLamada,
                        $segLlamada->fecha_siguiente_contacto
                    ];
                } else {
                    $aux[] = [
                        '',
                        '',
                        ''
                    ];
                }
            }
           $seguimientoLlamadas[] = $aux;
        }
        //dd($seguimientoLlamadas);
        return view('prospectos.seguimientoLlamadas.index', compact('prospectos', 'estatusLlamada', 'seguimientoLlamadas'));
    }

    /**
     * Guarda los registros del seguimiento de cada prospecto.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ($request->prospecto_id as $key => $prospecto) {
            $prospecto = Prospecto::find($prospecto);
            $seguimiento = SeguimientoLlamadas::create([
                'fecha_contacto' => $request->fecha_contacto[$key],
                'fecha_siguiente_contacto' => $request->fecha_siguiente_contacto[$key],
                'comentario' => $request->comentario[$key],
                'resultado_llamada_id' => $request->resultado_llamada_id[$key]
            ]);
            $seguimiento->asesor()->associate($prospecto->asesores()->where('activo', '1')->get()->last()->id);
            $seguimiento->save();
        }
    }
}
