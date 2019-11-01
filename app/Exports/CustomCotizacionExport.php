<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class CustomCotizacionExport extends DefaultValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
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

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

}
