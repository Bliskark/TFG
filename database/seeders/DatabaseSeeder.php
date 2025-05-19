<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\EquiposTableSeeder;
use Database\Seeders\EventosTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            EquiposTableSeeder::class,
            EventosTableSeeder::class,
        ]);
    }
}