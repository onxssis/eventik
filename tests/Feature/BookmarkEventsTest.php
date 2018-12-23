<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;
use App\User;

class BookmarkEventsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_unauthenticated_user_cant_bookmark_an_event()
    {
        $event = factory(Event::class)->create();

        $response = $this->json('POST', route('bookmarks.store'), [
            'event_id' => $event->id,
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test_an_authenticated_user_can_bookmark_an_event()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $response = $this->signIn($user)
            ->json('POST', route('bookmarks.store'), [
                'event_id' => $event->id,
            ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('bookmarks', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
    }

    public function test_an_authenticated_user_can_remove_an_event_from_his_bookmarks()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();
        $user = factory(User::class)->create();

        $user->addToBookmarks($event);

        $response = $this->signIn($user)
            ->json('DELETE', route('bookmarks.destroy', $event->id));

        $response->assertSuccessful();

        $this->assertDatabaseMissing('bookmarks', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
    }
}
