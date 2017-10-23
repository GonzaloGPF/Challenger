<?php

use Faker\Generator as Faker;

$factory->define(\App\Language::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'icon' => 'random_icon.png'
    ];
});
