<?php

namespace App\Policies;

use App\Channel;
use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user, Channel $channel)
    {
        return $user->channels->contains($channel->id);
    }
}
