<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//Broadcast::channel('channels', function () {
//    return true;
//});

Broadcast::channel('channel.{channelId}', function ($user, $channelId) {
    $channel = \App\Channel::find($channelId);
    if(auth()->check() && $user->can('join', $channel)) {
        return [
            'id' => $user->id,
            'name' => $user->name
        ];
    }
    return null;
});
