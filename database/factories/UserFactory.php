<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
    ];
});

$factory->define(App\Event::class, function (Faker $faker) {

    $title = $faker->sentence();

    $start_date = \Carbon\Carbon::now()->addHours(4);

    $end_date = $start_date->addHours(6);

    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->paragraphs(3, true),
        'price' => rand(0, 50000),
        'address' => $faker->address,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'start_date' => $start_date->toDateTimeString(),
        'end_date' => $end_date->toDateTimeString(),
    ];
});
