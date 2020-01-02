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

    	$prospectos = $this->getProspectosXEstatus("1");
    	$seguimientoLlamadas = $this->getSeguimientoLlamadaProspectos($prospectos);

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
            if(isset($request->fecha_contacto[$key]) && isset($request->resultado_llamada_id[$key])){
	            $seguimiento = SeguimientoLlamadas::create([
	                'fecha_contacto' => $request->fecha_contacto[$key],
	                'fecha_siguiente_contacto' => $request->fecha_siguiente_contacto[$key],
	                'comentario' => $request->comentario[$key],
	                'resultado_llamada_id' => $request->resultado_llamada_id[$key],
	                'prospecto_id' => $prospecto->id
	            ]);
	            $seguimiento->asesor()->associate($prospecto->asesores()->where('activo', '1')->get()->last()->id);
	            $seguimiento->save();
        	}
        }
        return redirect()->action('Prospecto\Seguimiento\SeguimientoLlamadasController@index');
    }

    public function noCalificado(Request $request)
    {
    	//dd($request->all());

    	$prospecto = Prospecto::find($request->prospecto);

    	$seguimiento = SeguimientoLlamadas::create([
            'fecha_contacto' => $request->fecha_actual,
            'fecha_siguiente_contacto' => $request->fechaSeguimiento,
            'comentario' => $request->comentario,
            'resultado_llamada_id' => $request->estatusId,
            'prospecto_id' => $prospecto->id
        ]);
        $prospecto->estatus_id = $request->estatusId;
        $prospecto->save();

        $prospectos = $this->getProspectosXEstatus("1");
        $seguimiento = $this->getSeguimientoLlamadaProspectos($prospectos);

        return response()->json(['prospecto' => $prospecto, "seguimiento" => $seguimiento, "prospectos" => $prospectos], 200);
    }

    public function getProspectosXEstatus($estatus_id)
    {
    	if ($empleado->tipo == 'Admin') {
    		$prospectos = Prospecto::where('estatus_id', '1')->get();
    	}
    	else {
    		$prospectos = $empleado->prospectos->where('estatus_id', $estatus_id)->get();
    	}

    	return $prospectos;
    }

    public function getSeguimientoLlamadaProspectos($prospectos)
    {
    	$seguimientoLlamadas = [];

        // Obtenemos los registros de las llamadas de cada prospecto, solo los ultimos 4
        foreach ($prospectos as $key => $value) {
            $aux = [];
            $segLlamada = $value->seguimientoLlamadas;

            for ($i=0; $i < 4; $i++) { 
                if(isset($segLlamada[$i])){
                	//dd($segLlamada[$i]->resultado_llamada_id);
                    $aux[] = [
                        $segLlamada[$i]->fecha_contacto,
                        ResultadoLlamada::find($segLlamada[$i]->resultado_llamada_id)->codigo,
                        $segLlamada[$i]->fecha_siguiente_contacto
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

        return $seguimientoLlamadas;
    }
}
