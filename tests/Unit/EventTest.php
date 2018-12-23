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
        $this->assertInstanceOf(\App\Category::class, $this->event->category);
    }

    /** @test */
    public function it_knows_if_it_is_bookmarked_or_not()
    {
        $user = factory(User::class)->create();

        $this->signIn($user);

        $user->addToBookmarks($this->event);

        $this->assertTrue($this->event->isBookmarkedByUser($user));
    }
}
