<?php

/** @var Factory $factory */

use App\Review;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->biasedNumberBetween($min = 0, $max = App\User::all()->count()),
        'space_id' => $faker->biasedNumberBetween($min = 0, $max = App\Space::all()->count()),
		'review' => $faker->realText,
    ];
});
