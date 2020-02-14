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

    public function getInitialsAttribute()
    {
        $parts = explode(' ', $this->name);

        return $parts[0][0] . $parts[1][0];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id');
    }

    public function attend($eventId = null)
    {
        $this->reservations()->create([
            'event_id' => $eventId
        ]);
    }

    public function unattend($eventId = null)
    {
        $this->reservations()->where([
            'event_id' => $eventId
        ])->first()->delete();
    }
}
