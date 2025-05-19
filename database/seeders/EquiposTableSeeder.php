<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;
use App\Models\Usuario;

class EquiposTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = Usuario::where('rol', '!=', 'admin')->get();
        $pokemons = [
            [25,6,3,9,1,150],
            [120,121,54,118,60,7],
            [147,148,149,6,143,59],
            [94,282,448,197,282,350]
        ];

        foreach ($users as $idx => $user) {
            Equipo::create([
                'usuario_id' => $user->id,
                'pokemon1_id' => $pokemons[$idx][0], 'level1' => 5, 'hp1' => 50,
                'pokemon2_id' => $pokemons[$idx][1], 'level2' => 5, 'hp2' => 50,
                'pokemon3_id' => $pokemons[$idx][2], 'level3' => 5, 'hp3' => 50,
                'pokemon4_id' => $pokemons[$idx][3], 'level4' => 5, 'hp4' => 50,
                'pokemon5_id' => $pokemons[$idx][4], 'level5' => 5, 'hp5' => 50,
                'pokemon6_id' => $pokemons[$idx][5], 'level6' => 5, 'hp6' => 50,
            ]);
        }
    }
}