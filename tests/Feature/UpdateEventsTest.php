<?php

namespace Tests\Feature;

use App\Category;
use App\Event;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Phaza\LaravelPostgis\Geometries\Point;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UpdateEventsTest extends TestCase
{
    use RefreshDatabase;

    public function testAnUnauthenticatedUserCantUpdateAnyEvent()
    {
        $event = factory(Event::class)->create();

        $this->get(route('events.edit', $event))
            ->assertRedirect('/login')
        ;

        $this->patch(route('events.update', $event))
            ->assertStatus(302)
            ->assertRedirect('/login')
        ;
    }

    public function testAnEventCantBeUpdatedUnlessByItsCreator()
    {
        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $event2 = factory(Event::class)->create();

        $categories = factory(Category::class, 3)->create();

        $ids = $categories->pluck('id')->toArray();

        $this->signIn($user)
            ->patch(route('events.update', $event2), [
                'title' => 'title changed',
                'description' => 'description changed',
                'price' => $event2->price,
                'address' => $event2->address,
                'start_date' => $event2->start_date,
                'end_date' => $event2->end_date,
                'categories' => $ids,
            ])
            ->assertStatus(403)
        ;

        $this->assertDatabaseHas('events', [
            'title' => $event2->title,
            'description' => $event2->description,
        ]);
    }

    public function testAnEventCanBeUpdatedByItsCreator()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'user_id' => $user->id,
        ]);

        $categories = factory(Category::class, 3)->create();

        $ids = $categories->pluck('id')->toArray();

        $response = $this->signIn($user)
            ->patch(route('events.update', $event), [
                'title' => 'title changed',
                'description' => 'description changed',
                'price' => $event->price,
                'address' => $event->address,
                'location' => '12.3332 -21.3443',
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'categories' => $ids,
            ])
            ->assertSuccessful()
        ;

        tap($event->fresh(), function ($event) {
            $this->assertEquals('title changed', $event->title);
            $this->assertEquals('title-changed', $event->slug);
            $this->assertEquals('description changed', $event->description);
            $this->assertEquals(new Point(-21.3443, 12.3332), $event->location);
        });
    }
}
