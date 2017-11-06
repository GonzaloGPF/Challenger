<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\Resource;

class MessagesResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user->id,
            'channel_id' => $this->channel->id,
            'created_at' => $this->created_at->toDateTimeString(),
            'text' => $this->text,
            'user' => new UsersResource(User::find($this->user->id))
        ];
    }
}
