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
        'password', 'remember_token',
    ];

    protected $casts = [
        'confirmed' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function createdChallenges()
    {
        return $this->hasMany(Challenge::class, 'creator_id');
    }

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class);
    }

    public function confirm()
    {
        $this->update([
            'confirmation_token' => null,
            'confirmed' => true
        ]);
    }
}
