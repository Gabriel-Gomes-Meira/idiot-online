<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Broadcasting\RoomChannel;

class BroadcastRoom implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $mensage;
    public $id;


    public function __construct($mensage, $id)
    {
        $this->mensage = $mensage;
        $this->id = $id;
    }

    public function broadcastWith()
    {
        return ["mensage" => $this->mensage];
    }


    public function broadcastOn()
    {
        return new PrivateChannel('Room.'.$this->id);
    }

}

// public function broadcastAs()
// {
//     return 'event_in_room'.$this->id;
// }
