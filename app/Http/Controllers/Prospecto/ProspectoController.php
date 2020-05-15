<?php

namespace App\Http\Controllers\Prospecto;

use App\Empleado;
use App\EmpleadoProspecto;
use App\Events\ProspectoCreated;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Presolicitud;
use App\Prospecto;
use App\Services\Prospecto\AsignarAsesorService;
use App\Services\Prospecto\AsignarAsesorTemporalIndefinidoService;
use App\Services\Prospecto\AsignarAsesorTemporalService;
use App\Services\Prospecto\DestroyProspectoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd( Auth::user()->empleado );
        $empleado = Auth::user()->empleado;

        if ($empleado->id == 1) {
            $prospectos = Prospecto::get();
        } elseif ($empleado->tipo == "Asesor") {
            $prospectos = $empleado->prospectos;
            // dd($prospectos);
        } elseif ($empleado->tipo == "Supervisor") {
            $prospectos = [];
            foreach ($empleado->empleados as $asesores) {
                foreach ($asesores->prospectos as $prospe) {
                    $prospectos[] = $prospe;
                }
            }
        } elseif ($empleado->tipo == "Gerente") {
            $prospectos = [];
            foreach ($empleado->empleados as $supervisores) {
                foreach ($supervisores->empleados as $asesores) {
                    foreach ($asesores->prospectos as $prospe) {
                        $prospectos[] = $prospe;
                    }
                }
            }
        } else {
            $prospectos = $empleado->prospectos;
        }

        // dd($prospectos);

        return view('prospectos.index', ['prospectos' => $prospectos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asesor = Auth::user()->empleado;
        return view('prospectos.create', ['asesor' => $asesor]);
    }

    public function asignarDirectivo(Prospecto $prospecto, Request $request)
    {
        $prospecto->update([
            'empleado_id' => $request->directivo_id
        ]);

        EmpleadoProspecto::create([
            'prospecto_id' => $prospecto->id,
            'empleado_id' => $request->directivo_id,
            'temporal' => 1,
            'activo' => 1,
            'fechaInicioTemporal' => date('Y-m-d'),
        ]);

        return redirect()->back();
    }

    public function enPresolicitud()
    {
        $prospectos = Auth::user()->empleado->prospectosActuales()->has('perfil')->has('cotizaciones')->get();
        $presolicitudes = Presolicitud::whereHas('perfil', function ($query) use ($prospectos) {
            return $query->has('cotizacion')->whereIn('prospecto_id', $prospectos->pluck('id')->flatten());
        })->get();
        $planes = Plan::get();
        return view('prospectos.en_presolicitud.index', compact('prospectos', 'presolicitudes', 'planes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formprospecto(Request $request)
    {
        // dd($request->alert->status);
        return view('prospectos.formprospecto', ['alert' => $request->alert]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitprospecto(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:191',
            'appaterno' => 'required|max:191',
            'apmaterno' => 'nullable|max:191',
            'sexo' => 'nullable|in:["","Hombre","Mujer"]',
            'email' => "required|e-mail",
            'telefono' => "nullable|numeric",
            'celular' => "required|numeric",
        ];
        // dd($this->validate($request,$rules));
        $prospecto = Prospecto::create($request->all());
        event(new ProspectoCreated($prospecto));
        return redirect()->route('prospecto.create', [
            'alert' => [
                'status' => "success",
                'message' => "Muy pronto un asesor se comunicará contigo"
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->input());
        // dd(Auth::user()->empleado->id);

        $rules = [
            'nombre' => 'required|max:191',
            'appaterno' => 'required|max:191',
            'apmaterno' => 'nullable|max:191',
            'email' => "required|e-mail",
            'telefono' => "nullable|numeric",
            'celular' => "required|numeric"
        ];
        $this->validate($request, $rules);
        $prospecto = new Prospecto($request->all());
        $prospecto->empleado_id = (Auth::user()->empleado->id == 1 ? null : Auth::user()->empleado->id);
        $prospecto->estatus_id = 1;
        $prospecto->save();

        // $prospecto = Prospecto::find($prospecto);
        $prospecto->asesores()->attach($prospecto->empleado_id, ['activo' => 1, 'temporal' => 0]);
        // Se asigna el estatus en seguimiento llamada
        $prospecto->estatus()->associate(1);
        $prospecto->save();

        return redirect()->route('empleados.prospectos.index', ['id' => Auth::user()->empleado]);
    }

    public function destroy(Prospecto $prospecto)
    {
        $destroyProspectoService = new DestroyProspectoService($prospecto);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto)
    {
        $empleado = Auth::user()->empleado;
        return view('prospectos.view', ['prospecto' => $prospecto, 'empleado' => $empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto)
    {
        $asesores = Empleado::where('cargo', 'Asesor')->get();
        return view('prospectos.edit', ['prospecto' => $prospecto, 'asesores' => $asesores]);
    }

    public function viewAsignar()
    {
        $asesores = Empleado::where('cargo', 'Asesor')->get();
        $prospectos = Prospecto::doesnthave('asesor')->get();

        return view('prospectos.asignar', compact('asesores', 'prospectos'));
    }

    public function asignarAsesor(Request $request)
    {
        try {
            //code...
            $asignarAsesorService = new AsignarAsesorService($request);
            $prospectos = Prospecto::whereNull('estatus_id')->get();
            return response(['prospectos' => $prospectos], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function asignarAsesorTemporal(Request $request)
    {
        try {
            //code...
            $asignarAsesorTemporalService = new AsignarAsesorTemporalService($request);
            return response()->json([
                'request' => $request->input()
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function asignarAsesorTemporalIndefinido(Request $request)
    {
        try {
            //code...
            $asignarAsesorTemporalIndefinidoService = new AsignarAsesorTemporalIndefinidoService($request);
            return response()->json([
                'request' => $request->input()
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto)
    {
        // dd($request->all());
        $prospecto->update($request->all());
        return redirect()->route('prospectos.show', ['prospecto' => $prospecto]);
    }

    /**
     * Muestra la vista para dar de alta por Excel.
     * 
     * @return \Illuminate\Http\Response
     */
    public function createExcel()
    {
        return view('prospectos.createExcel');
    }

    public function storeExcel(Request $request)
    {
        $validate = $request->validate([
            'excel_file' => 'required|file|mimes:xlsx'
        ], [  // Mensajes en caso de error.
            'required' => 'El archivo es requerido.',
            'file' => 'Debe ingresar un archivo',
            'mimes' => 'El archivo debe tener extension .xlsx'
        ]);

        ini_set('memory_limit', '-1');
        $rows = \Excel::toArray(null, request()->file('excel_file'))[0];
        // Quitamos el primer elemento del array, Los encabezados
        array_shift($rows);

        foreach ($rows as $key => $row) {

            $prospecto = $this->createProspecto($row);
        }
        return redirect()->back()->with('status', "Se cargo correctamente el archivo.");
    }

    /**
     * Valida que los campos no sean cadenas vacias ni que tenga columnas
     * nulas, crea un prospecto y lo devuelve, en caso de que tenga una
     * cadena vacia o una columna nula regresa null
     *
     * @return App\Prospecto | null
     */
    public function createProspecto($row)
    {
        if (
            $row[0] != '' && $row[1] != '' && $row[2] != '' && $row[3] != ''
            && $row[4] != '' && $row[5] != ''
        ) {

            $nombre    = ucfirst(trim($row[0]));
            $appaterno = ucfirst(trim($row[1]));
            $apmaterno = ucfirst(trim($row[2]));
            $email     = trim($row[3]);
            $celular   = trim(strval($row[4]));
            $telefono  = trim(strval($row[5]));

            $prospecto = Prospecto::firstOrCreate([
                "nombre"    => $nombre,
                "appaterno" => $appaterno,
                "apmaterno" => $apmaterno,
                "email"     => $email,
                "celular"   => $celular,
                "telefono"  => $telefono
            ]);

            return $prospecto;
        } else {
            return null;
        }
    }
}
