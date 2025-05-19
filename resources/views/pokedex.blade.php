@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
  <h1 class="text-3xl font-bold mb-6 text-center text-red-600">Pokédex</h1>

  @if(count($pokemons))
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($pokemons as $idx => $p)
        @php
          // extraer id de la URL
          $segments = explode('/', trim($p['url'], '/'));
          $pid = intval(end($segments));
        @endphp

        <a href="{{ route('pokedex.show', ['id' => $pid]) }}"
           class="block bg-gray-100 border-4 border-red-500 rounded-lg overflow-hidden shadow hover:shadow-xl transition">
          <div class="bg-red-500 p-2">
            <h2 class="text-lg font-bold text-white text-center">{{ ucfirst($p['name']) }}</h2>
          </div>
          <div class="p-4 flex justify-center">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ $pid }}.png"
                 alt="{{ $p['name'] }}"
                 class="w-20 h-20">
          </div>
        </a>
      @endforeach
    </div>

    <div class="flex justify-between items-center mt-8">
      @if($page > 1)
        <a href="?page={{ $page - 1 }}"
           class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">Anterior</a>
      @else
        <span></span>
      @endif

      @if($hasMore)
        <a href="?page={{ $page + 1 }}"
           class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">Siguiente</a>
      @endif
    </div>
  @else
    <p class="text-center text-gray-700">No se encontraron Pokémon. Intenta recargar la página.</p>
  @endif
</div>
@endsection
