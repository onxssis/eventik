<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class EventTest extends TestCase
{
    use RefreshDatabase;

    protected $event;

    public function setUp()
    {
        parent::setUp();

        $this->event = factory(\App\Event::class)->create();
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertInstanceOf(\App\User::class, $this->event->user);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->event->categories);
    }

    // /** @test */
    // public function it_knows_if_it_is_bookmarked_or_not()
    // {
    //     $user = factory(User::class)->create();

    //     $this->signIn($user);

    //     $user->addToBookmarks($this->event);

    //     $this->assertTrue($this->event->isBookmarkedByUser($user));
    // }

    /** @test */
    public function it_retrieves_its_upcoming_events()
    {
        $now = \Carbon\Carbon::now();
        $event1StartDate = \Carbon\Carbon::now()->addDays(2);
        $event2StartDate = \Carbon\Carbon::now()->addDays(3);

        factory(\App\Event::class, 5)->create([
            'start_date' => $now->subDays(14)->toDateTimeString(),
            'end_date' => $now->subDays(12)->toDateTimeString(),
        ]);

        factory(\App\Event::class)->create([
            'title' => 'Event 1',
            'start_date' => $event1StartDate->toDateTimeString(),
            'end_date' => $event1StartDate->addDay()->toDateTimeString(),
        ]);

        factory(\App\Event::class)->create([
            'title' => 'Event 2',
            'start_date' => $event2StartDate->toDateTimeString(),
            'end_date' => $event2StartDate->addDay()->toDateTimeString(),
        ]);

        $event = new \App\Event;

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $event->getUpcomingEvents());
        $this->assertCount(3, $event->getUpcomingEvents());
    }
}
