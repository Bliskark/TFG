@extends('layouts.app')

@section('title', 'Resultado de la Batalla')

@section('content')
<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow text-center space-y-4">
  @if(session('result') === 'win')
    <h1 class="text-3xl font-bold text-green-600">¡Victoria!</h1>
    <p>Has ganado y tu Pokémon sube de nivel.</p>
  @else
    <h1 class="text-3xl font-bold text-red-600">¡Derrota!</h1>
    <p>Tu Pokémon ha caído. ¡Inténtalo de nuevo!</p>
  @endif

  <div class="mt-6 flex justify-center space-x-4">
    <a href="{{ route('battle.show') }}" class="pokedex-btn bg-blue-500">Seguir Luchando</a>
    <a href="{{ route('home') }}" class="pokedex-btn bg-gray-500">Volver al Menú</a>
  </div>
</div>
@endsection
