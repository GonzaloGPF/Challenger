<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Events\UserJoinedToChannel;
use App\Events\UserLeftChannel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PusherController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function join(Request $request, Channel $channel = null)
    {
        if($request->has('channel')) { // Request from Pusher
            $channel = Channel::getChannelFromPusherChannelName($request->get('channel'));
            $user = auth()->user();

            if (!$channel->alreadyHasUser()) {
                $user->joinToChannel($channel);
            }

            broadcast(new UserJoinedToChannel($user, $channel))->toOthers();

            return response([], 200);
        }

        if($channel->isFull()){
            return response('Channel is full', Response::HTTP_FORBIDDEN);
        }

        return response([], 200);
    }

    // Always will come from Pusher
    public function leave(Request $request)
    {
        $user = auth()->user(); // TODO: check what is the authenticated user when comes from Pusher ('user_id')

        $channel = Channel::getChannelFromPusherChannelName($request->get('channel'));

        $user->leaveChannel($channel);

        broadcast(new UserLeftChannel($user, $channel))->toOthers();

        return response([], 200);
    }
}
