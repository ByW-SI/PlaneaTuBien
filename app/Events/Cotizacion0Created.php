<?php

namespace App\Events;

use App\Cotizacion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Cotizacion0Created implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cotizacion;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cotizacion $cotizacion)
    {
        //
        $this->cotizacion = $cotizacion;
        $this->message = "Se creo una nueva cotización sin pago inicial, haz click aquí para autorizarla.";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('prospecto-created');
    }

    public function broadcastAs()
    {
        return "cotizacion0-creada";
    }
}
