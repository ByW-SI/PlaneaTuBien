<?php

namespace App\Services\Cotizacion;

use App\Plan;

class CotizarPlanLibreService
{

    public function __construct($monto, $plan)
    {
        $this->monto = $monto;
        $this->plan = $plan;
    }

    public function get()
    {
        if (gettype($this->plan) == "string")
            $this->plan = Plan::find($this->plan);
        $res = $this->plan->getMontoscontratos($this->monto);
        $aux = [];
        foreach ($res as $this->monto) {
            switch ($this->monto) {
                case 300000:
                    $aux[] = ['minimo' => 1000, 'posible1' => 2000, 'posible2' => 3000, 'posible3' => 4000, 'maximo' => 5000];
                    break;
                case 350000:
                    $aux[] = ['minimo' => 2100, 'posible1' => 3100, 'posible2' => 4100, 'posible3' => 5100, 'maximo' => 5600];
                    break;
                case 400000:
                    $aux[] = ['minimo' => 2400, 'posible1' => 3400, 'posible2' => 4400, 'posible3' => 5400, 'maximo' => 6400];
                    break;
                case 450000:
                    $aux[] = ['minimo' => 2700, 'posible1' => 3700, 'posible2' => 4700, 'posible3' => 5700, 'maximo' => 7200];
                    break;
                case 500000:
                    $aux[] = ['minimo' => 3000, 'posible1' => 4000, 'posible2' => 5000, 'posible3' => 6000, 'maximo' => 8000];
                    break;
                case 550000:
                    $aux[] = ['minimo' => 3000, 'posible1' => 4000, 'posible2' => 5000, 'posible3' => 6000, 'maximo' => 8000];
                    break;
            }
        }
        $res = ['minimo' => 0, 'posible1' => 0, 'posible2' => 0, 'posible3' => 0, 'maximo' => 0];;
        foreach ($aux as $contrato) {
            $res['minimo'] += $contrato['minimo'];
            $res['posible1'] += $contrato['posible1'];
            $res['posible2'] += $contrato['posible2'];
            $res['posible3'] += $contrato['posible3'];
            $res['maximo'] += $contrato['maximo'];
        }
        return $res;
    }
}
