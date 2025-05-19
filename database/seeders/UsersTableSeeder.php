<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([ 'email' => 'ash@gmail.com', 'password' => bcrypt('pikachu123'), 'rol' => 'entrenador' ]);
        Usuario::create([ 'email' => 'misty@gmail.com', 'password' => bcrypt('misty123'), 'rol' => 'lider' ]);
        Usuario::create([ 'email' => 'lance@gmail.com', 'password' => bcrypt('dragon123'), 'rol' => 'alto_mando' ]);
        Usuario::create([ 'email' => 'cynthia@gmail.com', 'password' => bcrypt('champion123'), 'rol' => 'campeon' ]);
        Usuario::create([ 'email' => 'admin@gmail.com', 'password' => bcrypt('admin123'), 'rol' => 'admin' ]);
    }
}