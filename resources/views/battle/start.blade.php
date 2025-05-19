@extends('layouts.app')

@section('title', 'Elige tu Pokémon')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-2xl shadow-xl">
  <h1 class="text-3xl font-extrabold text-gray-800 mb-2 text-center">¡Prepárate para la batalla!</h1>
  <p class="text-gray-600 text-center mb-6">Selecciona el Pokémon con el que quieras empezar tu desafío:</p>

  <form action="{{ route('battle.start') }}" method="POST">
    @csrf
    <div class="grid grid-cols-2 gap-4">
      @for($i = 1; $i <= 6; $i++)
        @php
          $pokeId = $team->{"pokemon{$i}_id"};
          $level  = $team->{"level{$i}"};
          $sprite = $sprites[$i] ?? null;
        @endphp

        @if($pokeId)
          <label class="relative block cursor-pointer rounded-lg border-2 border-transparent hover:shadow-lg transition-shadow p-4 bg-gray-50 group">
            <input 
              type="radio" 
              name="pokemon_slot" 
              value="{{ $i }}" 
              class="absolute opacity-0 w-full h-full top-0 left-0" 
              @if($i===1) checked @endif
            >
            <div class="flex flex-col items-center">
              @if($sprite)
                <img src="{{ $sprite }}" alt="Sprite slot {{ $i }}" class="w-16 h-16 mb-2 pixelated group-hover:scale-105 transform transition-transform" />
              @else
                <div class="w-16 h-16 bg-gray-200 rounded mb-2"></div>
              @endif
              <span class="font-semibold text-gray-700 uppercase">Slot {{ $i }}</span>
              <span class="text-sm text-gray-500">Nivel {{ $level }}</span>
            </div>
            <div class="pointer-events-none absolute inset-0 rounded-lg border-4 border-blue-500 opacity-0 group-focus-within:opacity-100"></div>
          </label>
        @endif
      @endfor
    </div>

    <div class="mt-8 text-center">
      <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-full shadow-md hover:bg-blue-700 transition-colors">
        ¡Comenzar Batalla!
      </button>
    </div>
  </form>
</div>
@endsection
