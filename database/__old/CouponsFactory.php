<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code' => $faker->numberBetween($min = 9999, $max = 999999),
		'discount_type' => $faker->randomElement(['percentage', 'fixed']),
		'discount' => $faker->numberBetween($min = 1, $max = 100),
		'title' => $faker->realText($maxNbChars = 10),
		'description' => $faker->realText,
		'statue' => $faker->randomElement([0, 1]),
    ];
});
