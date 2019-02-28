<?php

namespace App\Http\Controllers\Precargas;

use App\Http\Controllers\Controller;
use App\Promocion;
use App\TipoPromocion;
use Illuminate\Http\Request;
use Validator;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->buscar) {
            $promociones = Promocion::where('nombre','LIKE',"%$request->buscar%")->orderBy('nombre','asc')->paginate(10);
        } else {
            $promociones = Promocion::orderBy('nombre','asc')->paginate(10);
        }
        return view('precargas.promocion.index',['promociones'=>$promociones,'buscar'=>$request->buscar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $promocion = new Promocion;
        // dd($promocion->nombre);
        $tipo_promociones = TipoPromocion::orderBy('nombre','asc')->get();
        return view('precargas.promocion.form',['promocion'=>$promocion,'tipo_promociones'=>$tipo_promociones,'edit'=>false]);
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
        $rules =[
            'nombre'=>'required|max:190',
            'monto'=>'required|numeric',
            'tipo_monto'=>'required|in:porcentaje,efectivo',
            'tipo_promo'=>'required',
            'valido_inicio'=>'required|date|after:today',
            'valido_fin'=>'required|date|after:valido_inicio',
            'descripcion'=>'nullable'

        ];
        $this->validate($request,$rules);
        $promocion = new Promocion($request->all());
        $tipo_promo = TipoPromocion::findOrFail($request->tipo_promo);
        $promocion->tipo_promocion()->associate($tipo_promo);
        $promocion->save();
        // Promocion::create($request->all());

        return redirect()->route('promocions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function show(Promocion $promocion)
    {
        //
        return view('precargas.promocion.show',['promocion'=>$promocion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promocion $promocion)
    {
        //
        $tipo_promociones = TipoPromocion::orderBy('nombre','asc')->get();
        return view('precargas.promocion.form',['promocion'=>$promocion,'tipo_promociones'=>$tipo_promociones,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promocion $promocion)
    {
        //
        $rules =[
            'nombre'=>'required|max:190',
            'monto'=>'required|numeric',
            'tipo_monto'=>'required|in:porcentaje,efectivo',
            'tipo_promo'=>'required',
            'valido_inicio'=>'required|date|after:today',
            'valido_fin'=>'required|date|after:valido_inicio',
            'descripcion'=>'nullable'

        ];
        $this->validate($request,$rules);
        $promocion->update($request->all());
        $tipo_promo = TipoPromocion::findOrFail($request->tipo_promo);
        $promocion->tipo_promocion()->associate($tipo_promo);
        $promocion->save();
        return redirect()->route('promocions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocion $promocion)
    {
        //
        $promocion->delete();
        return redirect()->route('promocions.index');

    }
    public function getPromo(Promocion $promocion)
    {
        $promocion->tipo_promocion;
        return response()->json(['promocion'=>$promocion],201);
    }
}
