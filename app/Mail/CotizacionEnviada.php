<?php

namespace App\Mail;

use App\Cotizacion;
use App\Empleado;
use App\Prospecto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotizacionEnviada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Cotizacion
     */
    public $cotizacion;

    /**
     * The order instance.
     *
     * @var Prospecto
     */
    public $prospecto;
    /**
     * The order instance.
     *
     * @var Empleado
     */
    public $asesor;
    /**
     * The order instance.
     *
     * @var $pdf
     */
    public $pdf;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cotizacion $cotizacion,$pdf)
    {
        //
        $this->cotizacion = $cotizacion;
        $this->prospecto = $cotizacion->prospecto;
        $this->asesor = $cotizacion->prospecto->asesor;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->asesor->email)
                    ->markdown('email.cotizacion')
                    ->attachData($this->pdf->output(), 'cotizacion'.date('d-m-Y')." ".$this->prospecto->nombre.'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
