<?php

namespace App\Http\Controllers;

use App\DepositoEfectivo;
use App\EstadoFinanciero;
use App\Imports\UserImport;
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

            $data = \Excel::toArray(null, request()->file('excel_file'));

            foreach ($data[0] as $registro) {
                if ($this->esConceptoValido($registro[1])) {
                    $registro[1] = $this->getOnlyReference($registro[1]);
                    $this->verifyPago($registro);
                    $this->saveExcelRow($registro);
                }
            }
        }
        return redirect()->route('excelpagos')->with('status', "Se cargo correctamente el archivo.");
    }

    public function esConceptoValido($concepto)
    {
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
        // Obtenemos la cadena izquierda a partir de "/"
        $reference = explode("/", $string);
        $reference = $reference[0];

        // Obtenemos los ultimos 14 digitos de la cadena
        $reference = substr($reference, -14);

        // Retornamos la referencia
        return $reference;
    }

    public function verifyPago($registro)
    {

        $referencia_banco = $registro[1];
        $abono_banco = $registro[3];
        $adeudo_siguiente_mes = 0;
        $abono_siguiente_mes = 0;

        // dd($abono_banco);

        $pago = Pagos::where('referencia', $referencia_banco)->where('monto',$abono_banco)->first();
        // dd($pago);

        // -- Si la referencia y el abono del banco se encuentran en los pagos del usuario
        if ($pago) {
            
            // -- Aprobamos el pago
            $pago->update(['status',1]);

            $plan = $pago->plan()->first();
            // dd($plan);
            $contrato = $pago->contrato()->first();
            $deberia_pagar = $plan->corrida_meses_fijos($contrato->monto)['integrante']['total'];
            // dd("A: ".$abono_banco." D: ".$deberia_pagar);

            // -- Si el abono de excel es menor a lo que en realidad debe pagar
            if ($abono_banco+1 < $deberia_pagar) {

                // -- Generamos adeudo
                $intereses = $deberia_pagar * 0.03;
                $iva = $intereses * 0.16;
                $adeudo_siguiente_mes = $deberia_pagar - $abono_banco + $intereses + $iva;
            }

            // -- Si el abono de excel es mayor a lo que deberia pagar
            else if($abono_banco+1 >= $deberia_pagar){

                // -- Generamos un abono para el siguiente mes
                $abono_siguiente_mes = $abono_banco - $deberia_pagar;
                // dd($abono_siguiente_mes);
            }

            // -- Actualizamos el adeudo y abono del cliente
            $estado_financiero = EstadoFinanciero::firstOrNew(
                ['contrato_id'=>$pago->contrato_id],
                ['adeudo'=>0,'abono'=>0,'recargo'=>0,'saldo'=>0]
            );
            // dd($estado_financiero);
            $estado_financiero->adeudo += $adeudo_siguiente_mes;
            $estado_financiero->abono += $abono_siguiente_mes;
            $estado_financiero->saldo = $estado_financiero->abono - $estado_financiero->adeudo;
            // dd($estado_financiero);
            $estado_financiero->save();

        }

        // dd('STOP');
    }
}
