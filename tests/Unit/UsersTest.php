<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Event;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_have_one_or_more_bookmarked_events()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->bookmarks);
    }

    public function test_a_user_can_bookmark_an_event()
    {
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();

        $user->addToBookmarks($event);

        $this->assertInstanceOf(Event::class, $user->bookmarks()->first());
    }

    public function test_a_user_can_remove_an_event_from_his_bookmarks()
    {
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();

        $user->addToBookmarks($event);

        $user->removeFromBookmarks($event);

        $this->assertNull($user->bookmarks()->first());
    }
}
