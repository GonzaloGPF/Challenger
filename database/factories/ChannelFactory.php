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

$factory->define(App\Channel::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'description' => $faker->paragraph,
        'capacity' => $faker->numberBetween(2, 50),
        'closed' => false,
        'public' => true,
        'creator_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'language_id' => function(){
            return factory(App\Language::class)->create()->id;
        },
        'category_id' => function(){
            return factory(\App\Category::class)->create()->id;
        }
    ];
});

$factory->state(App\Channel::class, 'closed', function(Faker $faker) {
    return [
        'closed' => true
    ];
});

$factory->state(App\Channel::class, 'private', function(Faker $faker) {
    return [
        'public' => false
    ];
});