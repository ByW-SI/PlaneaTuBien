<?php

namespace App\Http\Controllers;

use App\DepositoEfectivo;
use App\Imports\UserImport;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date as Dater;

class CargarEstadoCuentaExcelController extends Controller
{
    public function show(Request $request)
    {

        $depostios_efectivos = DepositoEfectivo::get();

        if ($request->input('query')) {
            $query = $request->input('query');
            $depostios_efectivos = DepositoEfectivo::referencia($query)->get();
            // return response()->json($depositos, 201);
        }

        return view('pagos.excel.show', compact('depostios_efectivos'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            // Obtenemos los datos del excel
            $data = \Excel::toArray(null, request()->file('excel_file'));
            // Recorremos cada uno de los datos
            foreach ($data[0] as $row) {
                // Si el concepto es valido
                if ($this->esConceptoValido($row[1])) {
                    // Obtenemos solo la referencia
                    $row[1] = $this->getOnlyReference($row[1]);
                    // dd($row[1]);
                    // Lo almacenamos en la base de datos
                    $this->saveExcelRow($row);
                }
            }
        }
        return "Success";
    }

    public function esConceptoValido($concepto)
    {
        if (strpos($concepto, 'DEPOSITO EFECTIVO') !== false) {
            return true;
        }
        if (strpos($concepto, 'DEPOSITO EN EFECTIVO') !== false) {
            return true;
        }
        if (strpos($concepto, 'CE000000') !== false) {
            return true;
        }
        return false;
    }

    public function saveExcelRow($row)
    {
        // Formateamos la fila de la fecha de excel
        $dia = Dater::excelToDateTimeObject($row[0]);
        $row[0] = $dia->format('Y-m-d');

        // Almacenamos el deposito
        DepositoEfectivo::create([
            'dia' => $row[0],
            'concepto' => $row[1],
            'cargo' => $row[2],
            'abono' => $row[3],
            'saldo' => $row[4],
        ]);
    }

    public function find(Request $request)
    {
        $query = $request->input('query');
        $depositos = DepositoEfectivo::referencia($query)->get();
        return response()->json($depositos, 201);
    }

    public function getOnlyReference($string)
    {
        // Eliminamos la parte izquierda de la cadena
        $reference = explode("/", $string);
        $reference = $reference[1];

        // Eliminamos la parte derecha de la cadena
        $reference = explode(" ", $reference);
        $reference = $reference[0];
        
        // Retornamos la referencia
        return $reference;
    }
}
