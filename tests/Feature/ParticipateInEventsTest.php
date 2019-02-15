<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Event;

class ParticipateInEvents extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_cant_register_to_an_event_without_logging_in()
    {
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $response = $this->post(route('events.attend', $event->slug))
            ->assertRedirect('/login');
    }

    public function test_a_user_can_register_to_an_event()
    {
        $this->withoutExceptionHandling();
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $this->signIn($user)
            ->post(route('events.attend', $event->slug));

        $this->assertDatabaseHas('reservations', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_a_user_cant_unregister_to_an_event_without_logging_in()
    {
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $response = $this->delete(route('events.unattend', $event->slug))
            ->assertRedirect('/login');
    }

    public function test_a_user_can_unregister_to_an_event()
    {
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $this->signIn($user)
            ->post(route('events.attend', $event->slug));

        $this->signIn($user)
            ->delete(route('events.unattend', $event->slug));

        $this->assertDatabaseMissing('reservations', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_a_user_can_bookmark_or_like_an_event()
    {
        $this->withoutExceptionHandling();
        // given a user is signed in
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();
        // and an event exist

        // when i visit the url to like/bookmark event
        $this->signIn($user)->post(route('bookmarks.store', $event->id));

        // it should be added to my bookmarks/likes
        $this->assertDatabaseHas('bookmarks', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_a_user_can_unbookmark_or_unlike_an_event()
    {
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $this->signIn($user)->post(route('bookmarks.store', $event->id));

        $this->signIn($user)->delete(route('bookmarks.destroy', $event->id));

        $this->assertDatabaseMissing('bookmarks', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }
}
