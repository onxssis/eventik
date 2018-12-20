<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;
use App\User;

class CreateEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthenticated_user_cant_view_create_form()
    {
        $this->get(route('events.create'))
            ->assertRedirect('/login');

        $this->post(route('events.store'))
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_create_an_event()
    {
        $user = factory(User::class)->create();

        $event = factory(Event::class)->make();

        $response = $this->actingAs($user)
            ->post(route('events.store', $event->toArray()));

        $response->assertJson($event->toArray());

        $this->assertDatabaseHas('events', [
            'title' => $event->title,
        ]);
    }

    public function test_all_event_fields_are_validated_correctly()
    {
        $this->publishEvent(['title' => ''])
            ->assertSessionHasErrors('title');

        $this->publishEvent(['description' => ''])
            ->assertSessionHasErrors('description');
    }

    protected function publishEvent($overrides = [])
    {
        $user = factory(User::class)->create();

        $event = factory(Event::class)->make($overrides);

        return $this->actingAs($user)
            ->post(route('events.store', $event->toArray()));
    }
}
