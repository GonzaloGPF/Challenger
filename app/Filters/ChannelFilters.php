<?php

namespace App\Filters;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ChannelFilters extends Filters
{
    protected $filters = ['by', 'popular', 'public', 'name'];

    /**
     * Filter by a username
     *
     * @param string $username
     * @return Builder
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter threads according to most popular
     *
     * @return Builder
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('users_count', 'DESC');
    }

    protected function public()
    {
        return $this->builder->where('public', true);
    }

    protected function name($name)
    {
        return $this->builder->where('name', $name);
    }
}