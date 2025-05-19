<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use Illuminate\Support\Facades\Http;

class StatisticsController extends Controller
{
    public function index()
    {
        // Construir la unión de los 6 slots, cada uno con su FROM
        $unionSql = implode(' UNION ALL ', [
            "SELECT pokemon1_id AS pid FROM equipos WHERE pokemon1_id IS NOT NULL",
            "SELECT pokemon2_id AS pid FROM equipos WHERE pokemon2_id IS NOT NULL",
            "SELECT pokemon3_id AS pid FROM equipos WHERE pokemon3_id IS NOT NULL",
            "SELECT pokemon4_id AS pid FROM equipos WHERE pokemon4_id IS NOT NULL",
            "SELECT pokemon5_id AS pid FROM equipos WHERE pokemon5_id IS NOT NULL",
            "SELECT pokemon6_id AS pid FROM equipos WHERE pokemon6_id IS NOT NULL",
        ]);

        // Contar usos agrupando el resultado de la unión
        $topPokemons = DB::table(DB::raw("({$unionSql}) AS all_pokemons"))
            ->select('pid', DB::raw('COUNT(*) AS cnt'))
            ->groupBy('pid')
            ->orderByDesc('cnt')
            ->limit(10)
            ->get();

        // Enriquecer con nombre e imagen desde PokéAPI
        $topPokemons = $topPokemons->map(function ($p) {
            $poke = Http::get("https://pokeapi.co/api/v2/pokemon/{$p->pid}")->json();
            return (object)[
                'pid'   => $p->pid,
                'name'  => ucfirst($poke['name']),
                'image' => $poke['sprites']['front_default'],
                'cnt'   => $p->cnt,
            ];
        });

        // Top 5 entrenadores
        $topUsers = Usuario::orderByDesc('victories')
            ->limit(5)
            ->get();

        return view('statistics', compact('topPokemons', 'topUsers'));
    }
}
