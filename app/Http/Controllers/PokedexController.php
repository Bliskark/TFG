<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PokedexController extends Controller
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://pokeapi.co/api/v2/']);
    }

    public function index(Request $request)
    {
        $page  = max(1, (int)$request->query('page', 1));
        $limit = 20;
        $offset= ($page - 1) * $limit;

        try {
            $response = $this->client->get("pokemon?limit={$limit}&offset={$offset}");
            $data     = json_decode($response->getBody(), true);
            $pokemons = $data['results'] ?? [];
            $hasMore  = !empty($data['next']);
        } catch (\Exception $e) {
            $pokemons = [];
            $hasMore  = false;
            $page     = 1;
        }

        return view('pokedex', compact('pokemons','page','hasMore'));
    }

    public function show($id)
    {
        try {
            $pRes = $this->client->get("pokemon/{$id}");
            $p    = json_decode($pRes->getBody(), true);
            $sRes = $this->client->get("pokemon-species/{$id}");
            $s    = json_decode($sRes->getBody(), true);
        } catch (\Exception $e) {
            abort(404);
        }

        $flavor = collect($s['flavor_text_entries'] ?? [])
            ->firstWhere('language.name', 'es')['flavor_text'] ?? '';

        return view('pokedex_show', [
            'pokemon'     => $p,
            'description' => $flavor,
        ]);
    }
}
