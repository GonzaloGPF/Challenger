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

    public function webHooks(Request $request) //TODO: study when/how test this (Pusher's web hooks)
    {
        $channel = Channel::getChannelFromPusherChannelName($request->get('channel'));
        $user = auth()->user();

//        if($request->has('member_added')) {
//            broadcast(new UserJoinedToChannel($user, $channel))->toOthers();
//        }

        if($request->has('member_removed')) {
            $user->leaveChannel($channel);
            broadcast(new UserLeftChannel($user, $channel))->toOthers();
        }

        return response([], 200);
    }
}
