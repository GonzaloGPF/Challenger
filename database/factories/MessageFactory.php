<?php

use Faker\Generator as Faker;

$factory->define(\App\Message::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence,
        'user_id' => function() {
            return factory(\App\User::class)->create()->id;
        },
        'channel_id' => function() {
            return factory(\App\Channel::class)->create()->id;
        }
    ];
});
