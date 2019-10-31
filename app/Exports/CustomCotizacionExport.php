<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomCotizacionExport implements FromView, ShouldAutoSize
{
	protected $plan;
    protected $monto;
    protected $res;

    public function __construct($plan, $monto, $res)
    {
        $this->plan = $plan;
        $this->monto = $monto;
        $this->res = $res;
    }

    public function view(): View
    {
    	return view('exports.cotizacionExcel', [
    		'plan'  => $this->plan,
            'monto' => $this->monto,
            'res'   => $this->res
    	]);
    }

}
