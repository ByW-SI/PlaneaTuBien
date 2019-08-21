<?php

namespace App\Http\Controllers;

use App\Pagos;
use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function index(){

        // $pagos = Pagos::get();

        // foreach($pagos as $pago){
        $contrato = Pagos::find(55)->contrato()->first();

        if($contrato){
            $presolicitud = $contrato->presolicitud()->first();

            if($presolicitud){
                $cotizacion = $presolicitud->cotizacion()->first();

                if($cotizacion){
                    $plan = $cotizacion->plan();
                }
            }
        }

        return $plan->get();
    }
}
