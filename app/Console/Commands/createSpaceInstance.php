<?php

namespace App\Console\Commands;

use App\Space;
use Faker\Factory;
use Illuminate\Console\Command;

class createSpaceInstance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:space';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $faker = Factory::create();
        $space = new Space();
        $space->name = $faker->name;
        $space->address = $faker->address;
        $space->description = $faker->words(10, true);
        $space->type = 'meeting';
        $space->capacity = '100';

        $space->save();
    }
}
