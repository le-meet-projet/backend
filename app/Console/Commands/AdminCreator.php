<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdminCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

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
     * @return int
     */
    public function handle()
    {

        \App\User::create([
            'email' => 'admin@admin.com',
            'role'  => "admin",
            'name'  => "admin",
            'phone'  => '0123456789',
            'password' => \Hash::make('1234'),
        ]);    

    }
}
