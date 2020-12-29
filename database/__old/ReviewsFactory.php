<?php

/** @var Factory $factory */

use App\Review;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->biasedNumberBetween($min = 0, $max = App\User::all()->count()),
        'meeting_id' => $faker->biasedNumberBetween($min = 0, $max = App\Meeting::all()->count()),
		'review' => $faker->realText,
    ];
});
