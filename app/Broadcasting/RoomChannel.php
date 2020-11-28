<?php

namespace App\Broadcasting;

use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomChannel
{
    public $name = 'room';
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->name = $this->name.$id;
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    // public function join(Room $room)
    // {
    //     $targetroom = DB::table('rooms')->where('id',$room->id);
    //     return $targetroom->qtdplayer<2;
    // }
}
