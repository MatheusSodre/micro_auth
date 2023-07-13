<?php

namespace Database\Seeders;

use Database\Seeders\Permissions\ResoucesSeeder;
use Database\Seeders\User\UserOrderSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ResoucesSeeder::class,
            UserOrderSeeder::class
        ]);
    }
}
