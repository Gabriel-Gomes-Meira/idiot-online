<?php

use App\Broadcasting\RoomChannel;
use App\Models\Room;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('Room.{id}', function (){
    return true;
});

//return $encrom->qtdplayer<2;
//$encrom = $rooms->find($id);
//$rooms = Room::all();
