<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Sucursal;
use App\EmpleadoDireccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\Empleado\StoreEmpleadoService;
use App\Services\Empleado\UpdateEmpleadoService;
use App\TipoPuesto;

class EmpleadoController extends Controller
{
    function __construct()
    {
        $this->middleware('empleados:indice recursos humanos')->only('index');
        $this->middleware('empleados:indice agentes')->only('indexAgentes');
        $this->middleware('empleados:crear rh')->only(['create', 'store']);
        $this->middleware('empleados:editar rh')->only(['edit', 'update']);
        $this->middleware('empleados:ver rh')->only('show');
        $this->middleware('empleados:eliminar rh')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::whereNotIn('id', [1])->get();
        return view('empleado.index', ['empleados' => $empleados]);
    }

    /**
     * Display a listing of the Agentes.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAgentes()
    {
        $empleados = Empleado::whereNotIn('id', [1]);
        $user = Auth::user()->empleado;
        switch ($user->tipo) {
            case 'Supervisor':
                $empleados = $user->empleados;
                break;

            case 'Gerente':
                $empleados = [];
                foreach ($user->empleados as $supervisores) {
                    foreach ($supervisores->empleados as $asesor) {
                        $empleados[] = $asesor;
                    }
                }
                break;

            default:
                $empleados = $empleados->where('cargo', "Asesor")->get();
                break;
        }
        return view('empleado.index', ['empleados' => $empleados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::get();
        $empleado = new Empleado;
        $gerentes = Empleado::get();
        $puestos = TipoPuesto::get();
        return view('empleado.form', ['sucursales' => $sucursales, 'empleado' => $empleado, 'gerentes' => $gerentes, 'puestos' => $puestos, 'edit' => false]);
        // return view('empleado.create', ['sucursales' => $sucursales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeEmpleadoService = new StoreEmpleadoService($request);
        return redirect()->route('empleados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::withTrashed()->find($id);
        // $posts = Post::withTrashed()->find($id);
        return view('empleado.datosgenerales.index', ['empleado' => $empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::withTrashed()->find($id);
        $sucursales = Sucursal::get();
        $gerentes = Empleado::get();
        return view('empleado.form', ['sucursales' => $sucursales, 'empleado' => $empleado, 'gerentes' => $gerentes, 'edit' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $updateEmpleadoService = new UpdateEmpleadoService($request, $empleado);
        return redirect()->route('empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado, Request $request)
    {

        $empleado->update([
            'motivo_baja' => $request->motivo,
            'es_recomendable' => $request->es_reingresable ? 1 : 0,
            'es_reingresable' => $request->es_recomendable ? 1 : 0,
        ]);

        is_null($empleado->user) ?: $empleado->user->delete();
        $empleado->delete();

        return redirect()->route('empleados.index');
    }

    public function deletedList(Request $request)
    {
        $empleadosEliminados = Empleado::onlyTrashed()->get();
        // dd($empleadosEliminados);
        return view('empleado.eliminados.lista', compact('empleadosEliminados'));
    }

    public function showDeleted($id)
    {
        $empleado = Empleado::withTrashed()->find($id);
        return view('empleado.datosgenerales.index', ['empleado' => $empleado]);
    }

    public function undelete(Request $request)
    {
        $empleado = Empleado::withTrashed()->find($request->input('empleado_id'));
        $empleado->restore();
        return redirect()->route('empleados.index');
    }

    public function buscarGerentes()
    {
        $gerentes = Empleado::where('puesto', 'Gerente')->get();
        return view('empleado.listaempleado', ['empleados' => $gerentes]);
    }

    public function buscarSupervisores()
    {
        $supervisores = Empleado::where('puesto', 'Supervisor')->get();
        return view('empleado.listaempleado', ['empleados' => $supervisores]);
    }

    public function getAsesores(Request $request)
    {
        $query = $request->input('query');
        $wordsquery = explode(' ', $query);
        $asesores = Empleado::where(function ($q) use ($wordsquery) {
            foreach ($wordsquery as $word) {
                $q->orWhere('nombre', 'LIKE', "%$word%")
                    ->orWhere('paterno', 'LIKE', "%$word%")
                    ->orWhere('materno', 'LIKE', "%$word%");
            }
        });
        $asesores = $asesores->where('tipo', 'Asesor')->get();
        return view('empleado.asesores', ['asesores' => $asesores]);
    }
}
