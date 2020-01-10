<?php

use App\Category;
use App\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $events = factory(Event::class, 70)->create();
        $categories = factory(Category::class, 15)->create();

        $events->each(function (Event $event) use ($categories) {
            $event->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
