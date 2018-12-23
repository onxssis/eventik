<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Event;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given event can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Event  $event
     * @return bool
     */
    public function update(User $user, Event $event)
    {
        return $user->id === (int)$event->user_id;
    }
}
