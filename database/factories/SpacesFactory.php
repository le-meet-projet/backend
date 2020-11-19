<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Space;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Space::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
		'address' => $faker->address,
		'description' => $faker->realText,
        'map' => $faker->sha256,
		'type' => $faker->randomElement(['workshop', 'meeting']),
		'date' => Carbon::now()->format('Y-m-d'),
		'time' => $faker->time($format = 'H:i:s', $max = 'now'),
		'capacity' => $faker->numberBetween($min = 10, $max = 100)
    ];
});
