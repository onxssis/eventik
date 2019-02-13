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

        $response = $this->post(route('events.attend', [
            'event' => $event->id,
        ]))->assertRedirect('/login');
    }

    public function test_a_user_can_register_to_an_event()
    {
        $this->withoutExceptionHandling();
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $this->signIn($user)
            ->post(route('events.attend', [
                'event' => $event->id,
            ]));

        $this->assertDatabaseHas('reservations', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_a_user_cant_unregister_to_an_event_without_logging_in()
    {
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $response = $this->post(route('events.unattend', [
            'event' => $event->id,
        ]))->assertRedirect('/login');
    }

    public function test_a_user_can_unregister_to_an_event()
    {
        $this->withoutExceptionHandling();
        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $this->signIn($user)
            ->post(route('events.attend', [
                'event' => $event->id,
            ]));

        $this->signIn($user)
            ->post(route('events.unattend', [
                'event' => $event->id,
            ]));

        $this->assertDatabaseMissing('reservations', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }
}
