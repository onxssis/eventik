<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;
use App\User;

class DeleteEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthenticated_user_cant_delete_any_event()
    {
        $event = factory(Event::class)->create();

        $this->delete(route('events.destroy', $event))
            ->assertRedirect('/login');
    }

    public function test_a_user_cant_delete_an_event_he_didnt_create()
    {
        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $event2 = factory(Event::class)->create();

        $this->signIn($user)
            ->delete(route('events.destroy', $event2))
            ->assertStatus(403);

        $this->assertDatabaseHas('events', [
            'title' => $event2->title,
            'description' => $event2->description,
        ]);
    }

    public function test_a_user_can_delete_an_event_he_created()
    {
        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $this->signIn($user)
            ->delete(route('events.destroy', $event))
            ->assertSuccessful();

        $this->assertDatabaseMissing('events', [
            'title' => $event->title,
            'description' => $event->description,
        ]);
    }
}
