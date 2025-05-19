@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Equipo de {{ $usuario->email }}</h1>

@if(session('success'))
  <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
    {{ session('success') }}
  </div>
@endif

@if($equipo)
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    @for($i = 1; $i <= 6; $i++)
      @php
        $pokeId = $equipo?->{"pokemon{$i}_id"};
        $level  = $equipo?->{"level{$i}"};
        $hp     = $equipo?->{"hp{$i}"};
        $poke = null;
        if ($pokeId) {
            try {
                $poke = \Illuminate\Support\Facades\Http::get("https://pokeapi.co/api/v2/pokemon/{$pokeId}")->json();
            } catch (\Exception $e) {}
        }
      @endphp

      @if($poke)
      <div class="bg-white border rounded shadow p-4 text-center">
        <img src="{{ $poke['sprites']['front_default'] }}" class="mx-auto mb-2">
        <h3 class="font-bold text-lg">{{ ucfirst($poke['name']) }}</h3>
        <p><strong>Nivel:</strong> {{ $level }}</p>
        <p><strong>HP:</strong> {{ $hp }}</p>
      </div>
      @endif
    @endfor
  </div>
@else
  <p>No tiene equipo.</p>
@endif

<hr class="my-6">

<h2 class="text-xl font-bold mb-4">Editar Equipo</h2>

<form action="{{ route('admin.usuarios.equipo.update', $usuario->id) }}" method="POST" class="space-y-6">
  @csrf
  @method('PUT')

  @for($i = 1; $i <= 6; $i++)
    @php
      $currentId = $equipo?->{"pokemon{$i}_id"};
      $currentLevel = $equipo?->{"level{$i}"} ?? '';
    @endphp

    <div class="border p-4 rounded bg-gray-100">
      <h3 class="font-semibold mb-2">Pokémon {{ $i }}</h3>

      <label class="block mb-1">Pokémon:</label>
      <select name="pokemon{{ $i }}_name" class="w-full border p-2 mb-2 rounded">
        <option value="">-- Selecciona un Pokémon --</option>
        @foreach($pokemons as $poke)
          <option value="{{ $poke['name'] }}"
            @if($poke['id'] === $currentId) selected @endif>
            {{ ucfirst($poke['name']) }}
          </option>
        @endforeach
      </select>

      <label class="block mb-1">Nivel:</label>
      <input type="number"
             min="1" max="100"
             name="level{{ $i }}"
             class="w-full border p-2 rounded"
             value="{{ old("level{$i}", $currentLevel) }}">
    </div>
  @endfor

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4">
    Guardar Cambios
  </button>
  <a href="{{ route('admin.usuarios.index') }}" class="ml-4 text-gray-600 hover:underline">
    ← Volver a usuarios
  </a>
</form>
@endsection
