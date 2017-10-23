<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ChannelFilters;
use App\User;

class UserProfilesController extends Controller
{
    public function show(User $user)
    {
        $user->load('createdChannels');

        if(\request()->wantsJson()) {
            return $user;
        }
        return view('profiles.show', compact('user'));
    }

    /**
     * @param ChannelFilters $filters
     * @return mixed
     */
    protected function getChannels(ChannelFilters $filters)
    {
        return Channel::latest()
            ->filter($filters)
            ->paginate(15);
    }
}
