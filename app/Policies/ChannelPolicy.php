<?php

namespace App\Policies;

use App\User;
use App\Channel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function view(User $user, Channel $channel)
    {
        //
    }

    /**
     * Determine whether the user can create channels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function update(User $user, Channel $channel)
    {
        return $user->id === (int) $channel->creator_id;
    }

    /**
     * Determine whether the user can delete the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function delete(User $user, Channel $channel)
    {
        //
    }

    public function join(User $user, Channel $channel)
    {
        return $channel->users()->count() < $channel->capacity;
    }

    public function leave(User $user, Channel $channel)
    {
        return $channel->alreadyHasUser($user);
    }
}
