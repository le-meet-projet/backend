<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rating;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    $users_id = User::get('id');
    return [
        'date' => Carbon::now()->format('Y-m-d'),
        'user_id' => $faker->randomElement($users_id)
    ];
});
