<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use App\User;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    $users_id = User::get('id');
    return [
        'user_id' => $faker->randomElement($users_id),
		'review' => $faker->realText,
		'rating' => $faker->numberBetween($min = 0, $max = 100)
    ];
});
