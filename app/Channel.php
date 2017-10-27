<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'description', 'capacity', 'public', 'creator_id', 'language_id'];

    protected $appends = ['pusher_name'];

    protected static function boot()
    {
        parent::boot();
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getPusherNameAttribute()
    {
        return "channel.$this->id";
    }

    public function path($extra = null)
    {
        $extra = $extra == null ? '' : '/' . $extra;
        return "channels/$this->name" . $extra;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function alreadyHasUser($user = null)
    {
        $user = $user ?: auth()->user();
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function isFull()
    {
        return $this->users()->count() === (int) $this->capacity;
    }

    public static function getChannelFromPusherChannelName($pusherChannelName)
    {
        $id = (int) str_replace('presence-channel.', '', $pusherChannelName);
        return Channel::find($id);;
    }

    public function scopePublic($query)
    {
        return $query->where('public', true);
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
