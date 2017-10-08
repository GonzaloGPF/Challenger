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

$factory->define(App\Challenge::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->paragraph,
        'end_date' => rand(0,1) ? null : $faker->dateTimeBetween('tomorrow', '1 month'),
        'creator_id' => function(){
            return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->state(App\Challenge::class, 'closed', function(Faker $faker) {
    return [
        'closed' => true
    ];
});