<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;
use App\User;
use App\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $event = factory(Event::class)->make();

        $categories = factory(Category::class, 3)->create();

        $ids = $categories->pluck('id')->toArray();

        $response = $this->actingAs($user)
            ->post(route('events.store', $event->toArray() + [
                'location' => $event->address,
                'categories' => $ids,
            ]));

        $this->assertDatabaseHas('events', [
            'title' => $event->title,
            'user_id' => $user->id
        ]);

        $freshEvent = Event::find(1);

        $this->assertInstanceOf(Category::class, $freshEvent->categories[0]);
    }

    public function test_all_event_fields_are_validated_correctly()
    {
        $this->publishEvent(['title' => ''])
            ->assertSessionHasErrors('title');

        $this->publishEvent(['description' => ''])
            ->assertSessionHasErrors('description');
    }

    public function test_an_event_requires_at_least_one_category()
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

        $event = factory(Event::class)->make($overrides);

        return $this->actingAs($user)
            ->post(route('events.store', $event->toArray()));
    }
}
