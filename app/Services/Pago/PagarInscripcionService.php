<?php

namespace App\Services\Pago;

use App\Cotizacion;
use MercadoPago;
use App\Events\PagoCreated;
use App\PagoInscripcion;
use App\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PagarInscripcionService
{

    protected $request;
    protected $errores;

    public function __construct(Prospecto $prospecto, Cotizacion $cotizacion, Request $request)
    {
        // dd($request->input());

        $this->setRequest($request);
        $this->prospecto = $prospecto;

        // $this->validarDatosCompra();

        if ($this->pagoPorMercadoPago()) {
            $this->realizarCompraMercadoPago();

            if (!$this->compraAprobada()) {
                // dd('error');
                return redirect()->back()->withErrors([
                    'message' => 'Compra no aprobada. Por favor, revisa que los datos sean validos'
                ]);
            }
        }

        // $rules = [
        //     'referencia' => 'required|alpha_num',
        //     'folio' => 'required',
        //     'identificacion' => 'required|in:INE,Pasaporte,Cédula Profesional,Cartilla,Otro',
        //     'comprobante' => 'required|in:Luz,Agua,Teléfono,Predial',
        //     'forma' => 'required|in:Efectivo,Depósito,Cheque,Tarjeta de Crédito,Tarjeta de Débito,Transferencia',
        //     'monto' => 'required|numeric'
        // ];
        // $this->validate($request, $rules);

        //return dd($request->all());
        $pago = new PagoInscripcion($request->all());
        $pago->prospecto()->associate($prospecto);
        $cotizacion->pago_inscripcions()->save($pago);
        event(new PagoCreated($prospecto, $pago, Auth::user()));
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function realizarCompraMercadoPago()
    {
        MercadoPago\SDK::setAccessToken( getenv('MERCADO_PAGO_ACCESS_TOKEN') );

        // dd($this->prospecto->email);

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $this->request->monto;
        $payment->token = $this->request->token;
        $payment->description = "Inscripción";
        $payment->installments = 1;
        $payment->payment_method_id = $this->request->paymentMethodId;
        $payment->payer = array(
            "email" => $this->request->email
        );
        // Save and posting the payment
        $payment->save();

        // dd($payment);

        $this->statusCompra = $payment->status;
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function pagoPorMercadoPago()
    {
        return $this->request->forma == 'Mercado Pago';
    }

    public function compraAprobada()
    {
        return $this->statusCompra == 'approved';
    }
}
