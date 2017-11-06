<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Events\UserJoinedToChannel;
use App\Events\UserLeftChannel;
use Symfony\Component\HttpFoundation\Response;

class JoinChannelController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function join(Channel $channel)
    {
        if($channel->isFull()){
            return response('Channel is full', Response::HTTP_FORBIDDEN);
        }

        $user = auth()->user();

        if (!$channel->alreadyHasUser($user)) {
            $user->joinToChannel($channel);
        }

        broadcast(new UserJoinedToChannel($user, $channel))->toOthers();

        return response([], 200);
    }

    public function leave(Channel $channel)
    {
        $user = auth()->user();

        if (!$channel->alreadyHasUser($user)) {
            $user->leaveChannel($channel);

            broadcast(new UserLeftChannel(auth()->user(), $channel))->toOthers();
        }

        return response([], 200);
    }
}
