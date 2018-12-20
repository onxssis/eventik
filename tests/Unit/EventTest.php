<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
