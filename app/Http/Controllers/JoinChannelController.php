<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Events\UserJoinedToChannel;
use App\Events\UserLeftChannel;

class JoinChannelController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function join(Channel $channel)
    {
        $this->authorize('join', $channel);

        $user = auth()->user();

        if (!$channel->alreadyHasUser($user)) {
            $user->joinToChannel($channel);
        }

        broadcast(new UserJoinedToChannel($user, $channel))->toOthers();

        return response(['hashedName' => $channel->hashedName], 200);
    }

    public function leave(Channel $channel)
    {
        $this->authorize('leave', $channel);

        auth()->user()->leaveChannel($channel);

        broadcast(new UserLeftChannel(auth()->user(), $channel))->toOthers();

        return response()->json(['message' => 'Channel left']);
    }
}
