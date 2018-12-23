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

    public function test_an_event_cant_be_updated_unless_by_its_creator()
    {
        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $event2 = factory(Event::class)->create();

        $this->signIn($user)
            ->patch(route('events.update', $event2), [
                'title' => 'title changed',
                'description' => 'description changed',
                'price' => $event2->price,
                'address' => $event2->address,
                'longitude' => $event2->longitude,
                'latitude' => $event2->latitude,
                'start_date' => $event2->start_date,
                'end_date' => $event2->end_date,
                'category_id' => $event2->category_id,
            ])
            ->assertStatus(403);

        $this->assertDatabaseHas('events', [
            'title' => $event2->title,
            'description' => $event2->description,
        ]);
    }

    public function test_an_event_can_be_updated_by_its_creator()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->signIn($user)
            ->patch(route('events.update', $event), [
                'title' => 'title changed',
                'description' => 'description changed',
                'price' => $event->price,
                'address' => $event->address,
                'longitude' => $event->longitude,
                'latitude' => $event->latitude,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'category_id' => $event->category_id,
            ])
            ->assertSuccessful();


        tap($event->fresh(), function ($event) {
            $this->assertEquals('title changed', $event->title);
            $this->assertEquals('title-changed', $event->slug);
            $this->assertEquals('description changed', $event->description);
        });
    }
}
