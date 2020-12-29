<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favorite;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    $users_id = User::get('id');
    return [
        'user_id' => $faker->randomElement($users_id),
		'date' => Carbon::now()->format('Y-m-d')
    ];
});
