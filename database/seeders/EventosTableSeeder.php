<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventosTableSeeder extends Seeder
{
    public function run(): void
    {
        $cases = [
            ['Sube de nivel','Tu Pokémon gana +1 nivel','+1 nivel','misterioso'],
            ['Curación total','Todos los Pokémon se curan','curarse entero','curar'],
            ['Herida inesperada','Un Pokémon pierde HP','perder vida','misterioso'],
            ['Nivel bajado','Un Pokémon baja 1 nivel','-1 nivel','misterioso'],
            ['Encuentro salvaje','Capturas un Pokémon aleatorio','capturar aleatorio','captura'],
        ];

        foreach ($cases as $e) {
            Evento::create([
                'name' => $e[0],
                'description' => $e[1],
                'efecto' => $e[2],
                'tipo' => $e[3],
            ]);
        }
    }
}