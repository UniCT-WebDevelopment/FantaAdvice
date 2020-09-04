<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Player;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name,
        'role' => 'A',
        'img' => 'https://i.ibb.co/zF3dvKK/A.png',
        'fantamedia' => 7,
        'last_score' => 7.5,
    ];
});