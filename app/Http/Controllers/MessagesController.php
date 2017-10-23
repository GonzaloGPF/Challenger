<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Events\MessageSent;
use App\Http\Resources\MessagesResource;
use App\Message;

class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @return array
     */
    public function index(Channel $channel)
    {
        return $this->getMessages($channel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function store(Channel $channel)
    {
        $this->authorize('create', [Message::class, $channel]);

        request()->validate([
            'text' => 'required',
        ]);

        $message = auth()->user()->messages()->create([
            'channel_id' => $channel->id,
            'text' => request('text')
        ]);

        broadcast(new MessageSent($channel, $message))->toOthers();

        return $message;
    }

    protected function getMessages(Channel $channel)
    {
        return MessagesResource::collection(Message::byChannel($channel->id)
            ->get());
    }
}
