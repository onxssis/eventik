<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bookmarks()
    {
        return $this->belongsToMany(Event::class, 'bookmarks', 'user_id', 'event_id');
    }

    public function addToBookmarks(Event $event)
    {
        return $this->bookmarks()->attach($event);
    }

    public function removeFromBookmarks(Event $event)
    {
        return $this->bookmarks()->detach($event);
    }
}
