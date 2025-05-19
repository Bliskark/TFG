<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Usuario;

class BattleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** 1) Pantalla inicial: elige tu Pokémon */
    public function show()
    {
        $user    = Auth::user();
        $team    = $user->equipo;
        $sprites = [];

        for ($i = 1; $i <= 6; $i++) {
            $pid = $team->{"pokemon{$i}_id"};
            if ($pid) {
                $poke        = Http::get("https://pokeapi.co/api/v2/pokemon/{$pid}")->json();
                $sprites[$i] = $poke['sprites']['front_default'];
            } else {
                $sprites[$i] = null;
            }
        }

        return view('battle.start', compact('team', 'sprites'));
    }

    /** 2) Iniciar combate tras elegir Pokémon inicial */
    public function start(Request $req)
    {
        $user = Auth::user();
        $slot = (int) $req->pokemon_slot;
        $data = $user->equipo->toArray();

        // Stats del jugador
        $pid   = $data["pokemon{$slot}_id"];
        $poke  = Http::get("https://pokeapi.co/api/v2/pokemon/{$pid}")->json();
        $stats = collect($poke['stats'])->keyBy('stat.name')->map(fn($s) => $s['base_stat']);

        $player = [
            'id'       => $pid,
            'name'     => $poke['name'],
            'sprite'   => $poke['sprites']['front_default'],
            'level'    => $data["level{$slot}"],
            'hp'       => $data["hp{$slot}"],
            'hp_max'   => $data["hp{$slot}"],
            'atk'      => $stats['attack'],
            'def'      => $stats['defense'],
            'satk'     => $stats['special-attack'],
            'sdef'     => $stats['special-defense'],
            'spd'      => $stats['speed'],
            'def_buff' => 0,
            'spc_buff' => 0,
        ];

        // Determinar tipo de rival por probabilidad
        $r = rand(1, 100);
        if ($r <= 10) {
            $type = 'campeon';
            $opponentUser = Usuario::where('rol', 'campeon')->inRandomOrder()->first();
        } elseif ($r <= 30) {
            $type = 'alto_mando';
            $opponentUser = Usuario::where('rol', 'alto_mando')->inRandomOrder()->first();
        } elseif ($r <= 60) {
            $type = 'lider';
            $opponentUser = Usuario::where('rol', 'lider')->inRandomOrder()->first();
        } else {
            $type = 'wild';
            $opponentUser = null;
        }

        // Stats del enemigo
        if ($type === 'wild') {
            $max = 1010; // o recuperar dinámicamente
            $wild   = Http::get("https://pokeapi.co/api/v2/pokemon/".rand(1, $max))->json();
            $wstats = collect($wild['stats'])->keyBy('stat.name')->map(fn($s)=>$s['base_stat']);
            $enemy  = [
                'id'       => $wild['id'],
                'name'     => $wild['name'],
                'sprite'   => $wild['sprites']['front_default'],
                'level'    => max(1, $player['level'] + rand(-2,2)),
                'hp'       => $wstats['hp'],
                'hp_max'   => $wstats['hp'],
                'atk'      => $wstats['attack'],
                'def'      => $wstats['defense'],
                'satk'     => $wstats['special-attack'],
                'sdef'     => $wstats['special-defense'],
                'spd'      => $wstats['speed'],
                'def_buff' => 0,
                'spc_buff' => 0,
            ];
        } else {
            // Tomar primer slot del líder/jefe
            $eq   = $opponentUser->equipo;
            $pid2 = $eq->pokemon1_id;
            $poke2  = Http::get("https://pokeapi.co/api/v2/pokemon/{$pid2}")->json();
            $wstats = collect($poke2['stats'])->keyBy('stat.name')->map(fn($s)=>$s['base_stat']);
            $enemy = [
                'id'       => $pid2,
                'name'     => $poke2['name'],
                'sprite'   => $poke2['sprites']['front_default'],
                'level'    => $eq->level1,
                'hp'       => $eq->hp1,
                'hp_max'   => $eq->hp1,
                'atk'      => $wstats['attack'],
                'def'      => $wstats['defense'],
                'satk'     => $wstats['special-attack'],
                'sdef'     => $wstats['special-defense'],
                'spd'      => $wstats['speed'],
                'def_buff' => 0,
                'spc_buff' => 0,
            ];
        }

        // Guardar estado en sesión
        session([
            'battle'      => [
                'player' => $player,
                'enemy'  => $enemy,
                'turn'   => 'player',
                'type'   => $type,
                'log'    => [],
            ],
            'battle.slot' => $slot,
        ]);

        return redirect()->route('battle.fight');
    }

    /** 3) Mostrar combate */
    public function fight()
    {
        $b = session('battle');
        return view('battle.fight', compact('b'));
    }

    /** 4) Procesar acción de combate */
    public function action(Request $req)
    {
        $b = session('battle');
        if ($b['turn'] !== 'player') abort(403);

        // Jugador actúa
        [$p, $e, $msg] = $this->resolve($b['player'], $b['enemy'], $req->action);
        $b['log'][]    = $msg;

        // Si el enemigo cae
        if ($e['hp'] <= 0) {
            session(['battle' => $b]);
            return $this->victory($p);
        }

        // Enemigo actúa
        [$e2, $p2, $msg2] = $this->enemyResolve($e, $p);
        $b['log'][]       = $msg2;

        // Si el jugador cae
        if ($p2['hp'] <= 0) {
            return redirect()->route('battle.result')->with('result','lose');
        }

        // Actualizar estado y continuar
        $b['player'] = $p2;
        $b['enemy']  = $e2;
        $b['turn']   = 'player';
        session(['battle' => $b]);

        return redirect()->route('battle.fight');
    }

    /** 5) Resultado final */
    public function result()
    {
        return view('battle.result');
    }

    /** Helper para resolver acción */
    protected function resolve(array $pl, array $en, string $act): array
    {
        $pl['def_buff'] = 0;
        $pl['spc_buff'] = 0;
        switch ($act) {
            case 'atk':
                $d = max(1, $pl['atk'] - $en['def']);
                $en['hp'] -= $d;
                $msg = "{$pl['name']} usa Ataque Físico ({$d} dmg)";
                break;
            case 'spc':
                $d = max(1, $pl['satk'] - $en['sdef']);
                $en['hp'] -= $d;
                $msg = "{$pl['name']} usa Ataque Especial ({$d} dmg)";
                break;
            case 'def':
                $pl['def_buff'] = 5;
                $msg = "{$pl['name']} sube Def. Física";
                break;
            case 'sdef':
                $pl['spc_buff'] = 5;
                $msg = "{$pl['name']} sube Def. Especial";
                break;
            case 'heal':
                $h = floor($pl['hp_max'] * 0.2);
                $pl['hp'] = min($pl['hp_max'], $pl['hp'] + $h);
                $msg = "{$pl['name']} se cura {$h} PS";
                break;
            default:
                $msg = '';
        }
        return [$pl, $en, $msg];
    }

    /** Helper para acción enemiga */
    protected function enemyResolve(array $en, array $pl): array
    {
        $acts = ['atk','spc','heal'];
        $act  = $acts[array_rand($acts)];
        switch ($act) {
            case 'atk':
                $d = max(1, $en['atk'] - $pl['def']);
                $pl['hp'] -= $d;
                $msg = "{$en['name']} usa Ataque Físico ({$d} dmg)";
                break;
            case 'spc':
                $d = max(1, $en['satk'] - $pl['sdef']);
                $pl['hp'] -= $d;
                $msg = "{$en['name']} usa Ataque Especial ({$d} dmg)";
                break;
            case 'heal':
                $h = floor($en['hp_max'] * 0.2);
                $en['hp'] = min($en['hp_max'], $en['hp'] + $h);
                $msg = "{$en['name']} se cura {$h} PS";
                break;
            default:
                $msg = '';
        }
        return [$en, $pl, $msg];
    }

    /** Al ganar: subir nivel y guardar victorias */
    protected function victory(array $player)
    {
        $user = Auth::user();
        $user->increment('victories');

        if ($player['level'] < 100) {
            $player['level']++;
        }
        $player['hp'] = $player['hp_max'];

        $slot = session('battle.slot');
        $eq   = $user->equipo;
        $eq->{"level{$slot}"} = $player['level'];
        $eq->{"hp{$slot}"}    = $player['hp_max'];
        $eq->save();

        session()->forget(['battle', 'battle.slot']);
        return redirect()->route('battle.result')->with('result','win');
    }
}
