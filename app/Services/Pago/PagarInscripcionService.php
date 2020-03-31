<?php

namespace App\Services\Pago;

use App\Cotizacion;
use MercadoPago;
use App\Events\PagoCreated;
use App\Mail\OrderShipped;
use App\PagoInscripcion;
use App\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PagarInscripcionService
{

    protected $request;
    protected $errores;

    protected $statusCompra;
    protected $detalleCompra;
    protected $message;
    protected $statement_descriptor;

    public function __construct(Prospecto $prospecto, Cotizacion $cotizacion, Request $request)
    {
        // dd($request->input());

        $this->setRequest($request);
        $this->prospecto = $prospecto;

        // $this->validarDatosCompra();

        if ($this->pagoPorMercadoPago()) {
            $this->realizarCompraMercadoPago();

            if ($this->compraAprobada()) {
                $this->message = "La compra ha sido aprobada exitosamente";
                Mail::to('cristianguzmansuarez@gmail.com')->send(new OrderShipped($this->payment));
            }

            if ($this->compraEnProceso()) {
                $this->message = "La compra está en proceso de validación. El cliente recibirá un correo con el resultado obtenido";
            }

            if ($this->compraRechazada()) {
                $this->message = "La compra fue rechazada. Por favor, verifica que la información sea correcta.";
                return;
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
        MercadoPago\SDK::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));

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
        $this->statusCompra = $payment->status;
        $this->detalleCompra = $payment->status_detail;
        $this->payment = $payment;
    }

    /**
     * =======
     * GETTERS
     * =======
     */

    public function getStatusCompra()
    {
        return $this->statusCompra;
    }

    public function getMensajeCompra()
    {

        if ($this->detalleCompra == 'accredited') {
            return 'El pago ha sido realizado exitosamente.';
        }

        if ($this->detalleCompra == 'pending_contingency') {
            return 'Pago pendiente de aceptación. Recibirás un correo con con el resultado de la verificación.';
        }

        if ($this->detalleCompra == 'cc_rejected_call_for_authorize') {
            return 'Pago rechazado. Por favor, llama para autorizar';
        }

        if ($this->detalleCompra == 'cc_rejected_insufficient_amount') {
            return 'Pago rechazado. El monto es insuficiente';
        }

        if ($this->detalleCompra == 'cc_rejected_bad_filled_security_code') {
            return 'Pago rechazado. Error en el código de seguridad.';
        }

        if ($this->detalleCompra == 'cc_rejected_bad_filled_date') {
            return 'Pago rechazado. Error en la fecha de expiración';
        }

        if ($this->detalleCompra == 'cc_rejected_bad_filled_other') {
            return 'Pago rechazado. Error en el formulario anterior. Por favor, verifica que los datos estén correctos.';
        }

        if ($this->detalleCompra == 'cc_rejected_other_reason') {
            return 'Pago rechazado. Por favor, verifica que los detalles de la compra sean correctos.';
        }
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

    public function compraEnProceso()
    {
        return $this->statusCompra == 'in_process';
    }

    public function compraRechazada()
    {
        return $this->statusCompra == 'rejected';
    }
}
