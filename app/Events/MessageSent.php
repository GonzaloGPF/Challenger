<?php

namespace App\Events;

use App\Message;
use App\User;
use App\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that sent the message
     *
     * @var User
     */
    public $channel;

    /**
     * Message details
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param Channel $channel
     * @param Message $message
     */
    public function __construct(Channel $channel, Message $message)
    {
        $this->channel = $channel;
        $this->message = $message->load('user');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Using the PrivateChannel class, Laravel is smart enough to know that we are creating a private channel,
        // so don’t prefix the channel name with private- (as specified by Pusher),
        // Laravel will add the private- prefix under the hood.
        return new PresenceChannel($this->channel->pusherName);
    }
}
