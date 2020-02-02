<?php

use App\Category;
use App\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $events = factory(Event::class, 70)->create();
        $categories = collect();
        $names = [
            'Music', 'Business', 'Education', 'Food & Drinks', 'Courses',
            'Sports & Fitness', 'Classes', 'Arts', 'Parties', 'Science & Tech',
            'Fashion', 'Health', 'Film & Media', 'Charity',
        ];

        $records = [];

        foreach ($names as $name) {
            array_push($records, [
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => '/images/categories/'.Str::slug($name).'.jpg',
            ]);
        }

        foreach ($records as $record) {
            $categories->push(Category::create($record));
        }

        $events->each(function (Event $event) use ($categories) {
            $event->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
