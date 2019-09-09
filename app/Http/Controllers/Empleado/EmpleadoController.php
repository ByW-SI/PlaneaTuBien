<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        return view('empleado.index', ['empleados'=>$empleados]);
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
        return view('empleado.index', ['empleados'=>$empleados]);
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
        return view('empleado.form',['sucursales'=>$sucursales,'empleado'=>$empleado,'edit'=>false]);
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
        

        $validator = Validator::make($request->all(), [
            'email' => 'nullable|unique:empleados',
            'rfc' => 'required|unique:empleados',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('status','ERROR: El correo o el RFC ya existe en el sistema');
        }

        $empleado = Empleado::create($request->all());
        if(!empty($request->input('gerente'))){
            $empleado->id_jefe = $request->input('gerente');
            $empleado->save();
        }
        if(!empty($request->input('supervisor'))){
            $empleado->id_jefe = $request->input('supervisor');
            $empleado->save();

        }
         $sucursal = Sucursal::find($request->sucursal);
        $empleado->sucursal()->associate($sucursal);
        $empleado->save();
        return redirect()->route('empleados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        // dd($empleado);
        return view('empleado.datosgenerales.index', ['empleado'=>$empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $sucursales = Sucursal::get();
        return view('empleado.form', ['sucursales'=>$sucursales,'empleado'=>$empleado,'edit'=>true]);  
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
        $empleado->update($request->all());
        $sucursal = Sucursal::find($request->sucursal);
        $empleado->sucursal()->associate($sucursal);
        $empleado->save();
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
        $empleado->update(['motivo_baja'=>$request->input('motivo')]);
        $empleado->delete();
        $empleado->user()->first() == null ? : $empleado->user()->first()->delete();
        return redirect()->route('empleados.index');
    }

    public function deletedList(Request $request){
        $empleadosEliminados = Empleado::onlyTrashed()->get();
        // dd($empleadosEliminados);
        return view('empleado.eliminados.lista',compact('empleadosEliminados'));
    }

    public function showDeleted($id){
        $empleado = Empleado::withTrashed()->find($id);
        return view('empleado.datosgenerales.index', ['empleado'=>$empleado]);
    }

    public function undelete(Request $request){
        $empleado = Empleado::withTrashed()->find($request->input('empleado_id'));
        $empleado->restore();
        return redirect()->route('empleados.index');
    }

    public function buscarGerentes(){
        $gerentes = Empleado::where('tipo', 'Gerente')->get();
        return view('empleado.listaempleado', ['empleados' => $gerentes]);
    }

    public function buscarSupervisores(){
        $supervisores = Empleado::where('tipo', 'Supervisor')->get();
        return view('empleado.listaempleado', ['empleados' => $supervisores]);
    }

    public function getAsesores(Request $request) {
        $query = $request->input('query');
        $wordsquery = explode(' ', $query);
        $asesores = Empleado::where(function($q) use($wordsquery) {
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
