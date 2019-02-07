<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;

class ViewEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_view_a_single_event()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();

        $this->get(route('events.show', $event))
            ->assertSuccessful();
            // ->assertSee($event->title);

    }
}
