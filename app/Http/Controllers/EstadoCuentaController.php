<?php

namespace App\Http\Controllers;

use App\DepositoEfectivo;
use App\Pagos;
use Illuminate\Http\Request;

class EstadoCuentaController extends Controller
{

    /**
     * Mostramos el detalle de uno de los estados de cuenta
     */

    public function detalle(Request $request)
    {
        $deposito_efectivo = DepositoEfectivo::where('id', $request->input('deposito_id'))->first();
        $presolicitud = $this->getPresolicitudByDepositoEfectivo($deposito_efectivo);
        $pago = Pagos::where('referencia', $deposito_efectivo->concepto)->first();

        return view('pagos.detalles.show', compact('deposito_efectivo', 'presolicitud', 'pago'));
    }

    /**
     * A partir del deposito en efectivo, obtenemos el contrato,
     * posteriormente, del contrato obtenemos la presolicitud
     * s
     * @param DepositoEfectivo $deposito_efectivo
     * @return Presolicitud $presolicitud
     */

    public function getPresolicitudByDepositoEfectivo($deposito_efectivo)
    {
        $presolicitud = null;
        if ($deposito_efectivo->contrato()->first()) {
            if ($deposito_efectivo->contrato()->first()->presolicitud()->first()) {
                $presolicitud = $deposito_efectivo->contrato()->first()->presolicitud()->first();
            }
        }
        return $presolicitud;
    }
}
