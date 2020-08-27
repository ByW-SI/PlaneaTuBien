<?php

namespace App\Events;

use App\Prospecto;
use App\Pagos;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Pago2Created implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     /**
     * prospecto que pago
     *
     * @var prospecto
     */
    public $prospecto;

    /**
     * pago que se realizo
     *
     * @var pago
     */
    public $pago;

    /**
     * mensaje a mostrar para el empleado
     *
     * @var mensaje
     */
    public $mensaje;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Prospecto $prospecto, Pagos $pago, User $user)
    {
        $this->prospecto = $prospecto;
        $this->pago = $pago;
        $this->mensaje = "Se realizo un pago de $ {$pago->monto} para el prospecto: {$prospecto->nombre} 
            {$prospecto->appaterno} {$prospecto->apmaterno}, y lo recibe el empleado: {$user->empleado->nombre} 
            {$user->empleado->paterno} {$user->empleado->materno}";
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
        return 'pago-creado';
    }
}
