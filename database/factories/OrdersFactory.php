<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use App\Order;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $users_id = User::get('id');
    $coupons_id = Coupon::get('id');
    return [
        'date' => Carbon::now()->format('Y-m-d'),
		'user_id' => $faker->randomElement($users_id),
		'payment_method' => $faker->randomElement(['VISA', 'Paypal']),
		'day' => $faker->dayOfMonth($max = 'now'),
		'hour' => $faker->numberBetween($min = 0, $max = 24),
		'type' => $faker->randomElement(['type1', 'type2']),
		'capacity' => $faker->numberBetween($min = 10, $max = 100),
		'status' => $faker->randomElement(['active', 'inactive']),
		'coupon_id' => $faker->randomElement($coupons_id)
    ];
});
