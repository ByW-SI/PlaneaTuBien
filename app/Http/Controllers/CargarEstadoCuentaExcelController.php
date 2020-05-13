<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\DepositoEfectivo;
use App\EstadoFinanciero;
use App\Imports\UserImport;
use App\Mensualidad;
use App\Pagos;
use App\Plan;
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
        }

        return view('pagos.excel.show', compact('depostios_efectivos'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('excel_file')) {

            $estados_financieros = \Excel::toArray(null, request()->file('excel_file'))[0];

            foreach ($estados_financieros as $registro) {
                if ($this->esConceptoValido($registro[1])) {
                    $registro[1] = $this->getOnlyReference($registro[1]);
                    $pago = $this->validarPagoSiExsite($registro);

                    if ($pago) {
                        $this->actualizarMensualidad($pago->mensualidad_id);
                    }

                    $this->saveExcelRow($registro);
                }
            }
        }
        return redirect()->route('excelpagos')->with('status', "Se cargo correctamente el archivo.");
    }

    public function esConceptoValido($concepto)
    {
        // Si la cadena contiene 'CE000000' es concepto valido
        if (strpos($concepto, 'CE000000') !== false) {
            return true;
        }

        // Si la cadena contiene  'DEPOSITO EN EFECTIVO' ES CONCEPTO VALIDO
        if (strpos($concepto, 'DEPOSITO EN EFECTIVO') !== false) {
            return true;
        }

        // Si la cadena contiene 'DEPOSITO EN EFECTIVO' Es concepto valido
        if (strpos($concepto, 'DEPOSITO EFECTIVO') !== false) {
            return true;
        }
        return false;
    }

    public function saveExcelRow($row)
    {
        // Formateamos la fila de la fecha de excel
        $dia = Dater::excelToDateTimeObject($row[0]);
        $row[0] = $dia->format('Y-m-d');

        // Almacenamos el deposito SOLO en caso de que no exista
        DepositoEfectivo::firstOrCreate([
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

        if (strpos($string, 'CE000000') === false) {
            return $string;
        }

        // Obtenemos la cadena izquierda a partir de "/"
        $reference = explode("/", $string);
        $reference = $reference[0];

        // Obtenemos los ultimos 14 digitos de la cadena
        $reference = substr($reference, -14);

        // Retornamos la referencia
        return $reference;
    }

    public function validarPagoSiExsite($registro)
    {

        $referencia_banco = $registro[1];
        $abono_banco = $registro[3];

        $pago = Pagos::where('referencia', $referencia_banco)->where('monto', $abono_banco)->first();

        if ($pago) {
            $pago->update([
                "status_id" => 1
            ]);
        }

        return $pago;
    }

    public function actualizarMensualidad($mensualidad_id)
    {

        $adeudo_siguiente_mes = 0;
        $abono_siguiente_mes = 0;

        $mensualidad = Mensualidad::where('id',$mensualidad_id)->first();
        $pagos_aprobados_de_mensualidad = $mensualidad->pagos()->aprobados()->get();
        // dd($pagos_aprobados_de_mensualidad);

        $total_pagado_a_mensualidad = 0;
        foreach($pagos_aprobados_de_mensualidad as $pago){
            $total_pagado_a_mensualidad += $pago->monto;
        }

        $total_debe = $mensualidad->cantidad + $mensualidad->recargo;

        if($total_pagado_a_mensualidad >= $total_debe){
            $mensualidad->update([
                "pagado" => 1,
            ]);
        }

        return $mensualidad;
    }
}
