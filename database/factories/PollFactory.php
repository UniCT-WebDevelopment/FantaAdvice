<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Poll;
use Faker\Generator as Faker;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'player1' => $faker->sentence,
        'player2' => $faker->sentence
    ];
});
