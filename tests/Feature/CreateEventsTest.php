<?php

namespace Tests\Feature;

use App\Category;
use App\Event;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateEventsTest extends TestCase
{
    use RefreshDatabase;

    public function testAnUnauthenticatedUserCantViewCreateForm()
    {
        $this->get(route('events.create'))
            ->assertRedirect('/login');

        $this->post(route('events.store'))
            ->assertRedirect('/login');
    }

    public function testAnAuthenticatedUserCanCreateAnEvent()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->make();

        $categories = factory(Category::class, 3)->create();

        $ids = $categories->pluck('id')->toArray();

        $response = $this->actingAs($user)
            ->post(
                route(
                    'events.store',
                    array_merge(
                        $event->toArray(),
                        ['location' => '6.56679 -21.34554', 'categories' => $ids]
                    )
                )
            );

        $this->assertDatabaseHas('events', [
            'title' => $event->title,
            'user_id' => $user->id
        ]);

        $freshEvent = Event::first();

        $this->assertInstanceOf(Category::class, $freshEvent->categories[0]);
    }

    public function testAllEventFieldsAreValidatedCorrectly()
    {
        $this->publishEvent(['title' => ''])
            ->assertSessionHasErrors('title');

        $this->publishEvent(['description' => ''])
            ->assertSessionHasErrors('description');
    }

    public function testAnEventRequiresAtLeastOneCategory()
    {
        $categories = factory(Category::class, 3)->create();

        $ids = $categories->pluck('id')->toArray();

        $this->publishEvent(['categories' => null])
            ->assertSessionHasErrors('categories');

        $this->publishEvent(['categories' => []])
            ->assertSessionHasErrors('categories');

        $this->publishEvent(['categories' => $ids])
            ->assertSessionDoesntHaveErrors('categories');
    }

    // public function test_an_event_requires_an_image()
    // {
    //     $this->publishEvent(['image' => ''])
    //         ->assertSessionHasErrors('image');

    //     $this->publishEvent(['image' => 'not-an-image'])
    //         ->assertSessionHasErrors('image');
    // }

    protected function publishEvent($overrides = [])
    {
        $user = factory(User::class)->create();

        $event = factory(Event::class)->make();

        $transformedEvent = array_merge($event->toArray(), $overrides);

        return $this->actingAs($user)
            ->post(route('events.store', array_merge(
                $transformedEvent,
                ['location' => '6.56679 -21.34554']
            )))
        ;
    }
}
