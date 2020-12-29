<?php

use Illuminate\Database\Seeder;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Meeting::class, 10)->create();
        factory(App\Vacation::class, 10)->create();
        factory(App\Workshop::class, 10)->create();
    }
}
