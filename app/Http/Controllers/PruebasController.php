<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Mensualidad;
use App\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PruebasController extends Controller
{
    public function index()
    {
        $nuevo_recargo = 0;
        $nuevo_abono = 0;
        $contratos_registrados = Contrato::registrados()->get();

        foreach($contratos_registrados as $contrato){
            $ultima_mensualidad = Mensualidad::where('contrato_id',$contrato->id)->last()->first();

            if($ultima_mensualidad){
                $nuevo_recargo = $this->getRecargo($ultima_mensualidad);
                $nuevo_abono = $this->getAbono($ultima_mensualidad);
            }

            $ultima_mensualidad->update([
                'pagado' => 1
            ]);

            $nueva_mensualidad = Mensualidad::create([
                "contrato_id" => $ultima_mensualidad->contrato_id,
                "num_mes" => $ultima_mensualidad->num_mes+1,
                "cantidad" => $ultima_mensualidad->monto-$nuevo_abono,
                "fecha" => Carbon::now(),
                "recargo" => $nuevo_recargo
            ]);
        }

        return $nueva_mensualidad;
    }

    public function getRecargo($mensualidad){
        $nuevo_recargo = 0;

        $pagos_de_mensualidad = $mensualidad->pagos()->get();

        $debe_pagar = $mensualidad->cantidad + $mensualidad->recargo;

        $total_pagado_a_mensualidad = 0;
        foreach($pagos_de_mensualidad as $pago){
            $total_pagado_a_mensualidad += $pago->monto;
        }

        if($total_pagado_a_mensualidad+1 < $debe_pagar){
            $intereses = $debe_pagar * 0.03;
            $iva = $intereses * 0.16;
            $nuevo_recargo = $debe_pagar - $total_pagado_a_mensualidad + $intereses + $iva;
        }

        return $nuevo_recargo;

    }

    public function getAbono($mensualidad){
        $nuevo_abono = 0;

        $pagos_de_mensualidad = $mensualidad->pagos()->get();

        $debe_pagar = $mensualidad->cantidad + $mensualidad->recargo;

        $total_pagado_a_mensualidad = 0;
        foreach($pagos_de_mensualidad as $pago){
            $total_pagado_a_mensualidad += $pago->monto;
        }

        if($total_pagado_a_mensualidad-1 >= $debe_pagar){
            $nuevo_abono = $total_pagado_a_mensualidad - $debe_pagar;
        }

        return $nuevo_abono;
    }

}
