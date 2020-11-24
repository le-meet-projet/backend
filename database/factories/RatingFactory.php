<?php

/** @var Factory $factory */

use App\Rating;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'user_id' => $faker->biasedNumberBetween($min = 0, $max = App\User::all()->count()),
        'value' => $faker->biasedNumberBetween(0, 100),
        'space_id' => $faker->biasedNumberBetween($min = 0, $max = App\Space::all()->count()),
    ];
});
