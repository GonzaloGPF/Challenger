<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token', 'confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'confirmation_token'
    ];

    protected $casts = [
        'confirmed' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class);
    }

    public function createdChannels()
    {
        return $this->hasMany(Channel::class, 'creator_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function joinToChannel(Channel $channel)
    {
        $this->channels()->save($channel);
        $channel->increment('users_count');
        return $this;
    }

    public function leaveChannel(Channel $channel)
    {
        $this->channels()->detach($channel->id);
        $channel->decrement('users_count');
        return $this;
    }

    public function confirm()
    {
        $this->update([
            'confirmation_token' => null,
            'confirmed' => true
        ]);
    }
}
