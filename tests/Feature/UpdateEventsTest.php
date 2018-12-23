<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;
use App\User;

class UpdateEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthenticated_user_cant_update_any_event()
    {
        $event = factory(Event::class)->create();

        $this->get(route('events.edit', $event))
            ->assertStatus(302)
            ->assertRedirect('/login');

        $this->patch(route('events.update', $event))
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    // function a_thread_requires_a_title_and_body_to_be_updated()
    // {
    //     $thread = create('App\Thread', ['user_id' => auth()->id()]);
    //     $this->patch($thread->path(), [
    //         'title' => 'Changed'
    //     ])->assertSessionHasErrors('body');
    //     $this->patch($thread->path(), [
    //         'body' => 'Changed'
    //     ])->assertSessionHasErrors('title');
    // }

    public function test_an_event_cant_be_updated_unless_by_its_creator()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $event2 = factory(Event::class)->create();

        $this->signIn($user)
            ->patch(route('events.update', $event2), [
                'title' => 'title changed',
                'description' => 'description changed',
            ])
            ->assertStatus(401);

        $this->assertDatabaseHas('events', [
            'title' => $event2->title,
            'description' => $event2->description,
        ]);
    }

    public function test_an_event_can_be_updated_by_its_creator()
    {
        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $this->signIn($user)
            ->patch(route('events.update', $event), [
                'title' => 'title changed',
                'description' => 'description changed',
            ])
            ->assertSuccessful();

        tap($event->fresh(), function ($event) {
            $this->assertEquals('title changed', $event->title);
            $this->assertEquals('title-changed', $event->slug);
            $this->assertEquals('description changed', $event->description);
        });
    }
}
