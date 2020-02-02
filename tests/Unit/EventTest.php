<?php

namespace Tests\Unit;

use App\Repositories\Event\EloquentEventRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    protected $event;
    protected $repo;

    public function setUp(): void
    {
        parent::setUp();

        $this->event = factory(\App\Event::class)->create();
        $this->repo = new EloquentEventRepository($this->event);
    }

    /** @test */
    public function itBelongsToAUser()
    {
        $this->assertInstanceOf(\App\User::class, $this->event->user);
    }

    /** @test */
    public function itBelongsToACategory()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->event->categories);
    }

    /** @test */
    public function itRetrievesItsUpcomingEvents()
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

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->repo->getUpcomingEvents());
        $this->assertCount(3, $this->repo->getUpcomingEvents());
    }
}
