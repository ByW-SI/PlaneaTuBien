<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FichaPagoEfectivoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
    * Atributo para recibir el request recibido de la vista
    * @var cliente
    */
    public $cliente;

    /**
    * Atributo para obtener datos del cliente al que se le envia
    * @var pdf
    */
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf, $cliente)
    {
        $this->pdf = $pdf;
        $this->cliente = $cliente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("pruebasbyw@gmail.com")
                    ->markdown('email.fichaEfectivo')
                    ->attachData($this->pdf->output(), 'FichaEfectivo'.date('d-m-Y')." ".$this->cliente->nombre.$this->cliente->paterno.$this->cliente->materno.'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
