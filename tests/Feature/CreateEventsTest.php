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

        $response = $this->actingAs($user)
            ->post(route('events.store', $event->toArray()));

        $this->assertDatabaseHas('events', [
            'title' => $event->title,
            'user_id' => $user->id
        ]);
    }

    public function test_all_event_fields_are_validated_correctly()
    {
        $this->publishEvent(['title' => ''])
            ->assertSessionHasErrors('title');

        $this->publishEvent(['description' => ''])
            ->assertSessionHasErrors('description');
    }

    public function test_an_event_requires_a_category()
    {
        factory(Category::class)->create();

        $this->publishEvent(['category_id' => null])
            ->assertSessionHasErrors('category_id');

        $this->publishEvent(['category_id' => 88])
            ->assertSessionHasErrors('category_id');
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
