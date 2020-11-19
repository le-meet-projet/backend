<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Brand::class, 10)->create();
        factory(App\Coupon::class, 10)->create();
        factory(App\User::class, 10)->create();
        factory(App\Favorite::class, 10)->create();
        factory(App\Order::class, 10)->create();
        factory(App\Rating::class, 10)->create();
        factory(App\Review::class, 10)->create();
        factory(App\Space::class, 10)->create();
    }
}
