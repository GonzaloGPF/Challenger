<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public function path($extra = null)
    {
        $extra = $extra == null ? '' : '/' . $extra;
        return "challenges/$this->slug" . $extra;
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @param Builder $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter(Builder $query, $filters)
    {
        return $filters->apply($query);
    }
}
