<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Filters\ChallengeFilters;
use App\User;
use Illuminate\Http\Request;

class UserProfilesController extends Controller
{
    public function show(User $user)
    {
        $user->load('challenges')
            ->load('createdChallenges');

        if(\request()->wantsJson()) {
            return $user;
        }
        return view('profiles.show', compact('user'));
    }

    /**
     * @param ChallengeFilters $filters
     * @return mixed
     */
    protected function getChallenges(ChallengeFilters $filters)
    {
        return Challenge::latest()
            ->filter($filters)
            ->paginate(15);
    }
}
