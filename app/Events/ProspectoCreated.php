<?php

namespace App\Events;

use App\Prospecto;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProspectoCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $prospecto;
    public $mensaje;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Prospecto $prospecto)
    {
        //
        $this->prospecto=$prospecto;
        $this->mensaje = "El prospecto {$prospecto->nombre} {$prospecto->appaterno} {$prospecto->apmaterno} a solicitado información";
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

    public function broadcastAs(){
        return 'prospecto-creado';
    }
}
