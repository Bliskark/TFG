<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class EquipoController extends Controller
{
    protected Client $client;

    public function __construct()
    {
        if (method_exists($this, 'middleware')) {
            $this->middleware('auth');
        }

        $this->client = new Client(['base_uri' => 'https://pokeapi.co/api/v2/']);
    }

    public function index()
    {
        // Recupera el equipo, forzando manual si no hay relación
        $equipo = Auth::user()->equipo ?? Equipo::where('usuario_id', Auth::id())->first();
        $datos = [];

        if ($equipo) {
            for ($i = 1; $i <= 6; $i++) {
                $id = $equipo->{"pokemon{$i}_id"};
                if ($id) {
                    try {
                        $res = $this->client->get("pokemon/{$id}");
                        $datos[] = json_decode($res->getBody(), true);
                    } catch (\Exception $e) {
                        $datos[] = null;
                    }
                }
            }
        }

        return view('equipo', compact('equipo', 'datos'));
    }

    public function create()
    {
        // No permitir crear si ya tiene equipo
        $equipo = Auth::user()->equipo ?? Equipo::where('usuario_id', Auth::id())->first();
        if ($equipo) {
            return redirect()->route('equipo.index')->with('error', 'Ya tienes un equipo creado.');
        }

        // Carga lista de Pokémon con name e id
        $pokemons = [];
        try {
            $res = Http::get('https://pokeapi.co/api/v2/pokemon?limit=1010')->json()['results'];
            $pokemons = collect($res)->map(fn($p) => [
                'name' => $p['name'],
                'id'   => intval(Arr::last(explode('/', rtrim($p['url'], '/'))))
            ])->toArray();
        } catch (\Exception $e) {
            $pokemons = [];
        }

        return view('equipo_create', compact('pokemons'));
    }

    public function store(Request $request)
    {
        $data = ['usuario_id' => Auth::id()];

        for ($i = 1; $i <= 6; $i++) {
            $pokeName = $request->input("pokemon{$i}_name");
            if ($pokeName) {
                try {
                    $poke = Http::get("https://pokeapi.co/api/v2/pokemon/{$pokeName}")->json();
                    $baseHP = collect($poke['stats'])->firstWhere('stat.name', 'hp')['base_stat'];
                    $level = (int) $request->input("level{$i}");
                    $calculatedHp = floor(((2 * $baseHP * $level) / 100) + $level + 10);

                    $data["pokemon{$i}_id"] = $poke['id'];
                    $data["level{$i}"]      = $level;
                    $data["hp{$i}"]         = $calculatedHp;
                } catch (\Exception $e) {
                    // Ignora si falla
                }
            }
        }

        Equipo::updateOrCreate(['usuario_id' => Auth::id()], $data);
        return redirect()->route('equipo.index')->with('success', 'Equipo guardado correctamente.');
    }

    public function edit()
    {
        $equipo = Auth::user()->equipo ?? Equipo::where('usuario_id', Auth::id())->first();

        $pokemons = [];
        try {
            $res = Http::get('https://pokeapi.co/api/v2/pokemon?limit=1010')->json()['results'];
            $pokemons = collect($res)->map(fn($p) => [
                'name' => $p['name'],
                'id'   => intval(Arr::last(explode('/', rtrim($p['url'], '/'))))
            ])->toArray();
        } catch (\Exception $e) {
            $pokemons = [];
        }

        return view('equipo_edit', compact('equipo', 'pokemons'));
    }

    public function update(Request $request)
    {
        return $this->store($request);
    }
}
