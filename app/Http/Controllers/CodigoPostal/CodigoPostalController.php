<?php

namespace App\Http\Controllers\CodigoPostal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CodigoPostal;


class CodigoPostalController extends Controller
{
    //
    public function getCP($cp)
    {
    	
    	$res = CodigoPostal::where('codigo_postal',$cp)->get();
    	if($res->isEmpty()){
    		return response()->json(['error'=>'codigo postal no encontrado'],404);
    	}
    	else{
    		
    		return response()->json(['cp'=>$res],201);

    	}

    }
    public function getColonia($cp,$colonia)
    {
    	$res = CodigoPostal::where([
    		['codigo_postal',$cp],
    		['poblacion',$colonia],

    	])->get();
    	if($res->isEmpty()){
    		return response()->json(['error'=>'codigo postal no encontrado'],404);
    	}
    	else{
    		
    		return response()->json(['cp'=>$res],201);

    	}
    }
}
