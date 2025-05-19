@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Equipo</h1>

<form action="{{ route('equipo.update') }}" method="POST" class="space-y-6">
  @csrf
  @method('PUT')

  @for($i = 1; $i <= 6; $i++)
    @php
      $currentId = $equipo->{'pokemon'.$i.'_id'} ?? null;
    @endphp

    <div class="border p-4 rounded bg-white shadow">
      <h2 class="font-semibold mb-2">Pokémon {{ $i }}</h2>

      <label>Pokémon:</label>
      <select name="pokemon{{ $i }}_name" class="w-full border p-2 mb-2 rounded">
        <option value="">-- Selecciona un Pokémon --</option>
        @foreach($pokemons as $poke)
          <option value="{{ $poke['name'] }}"
            @if($poke['id'] === $currentId) selected @endif>
            {{ ucfirst($poke['name']) }}
          </option>
        @endforeach
      </select>

      <label>Nivel:</label>
      <input type="number"
             min="1" max="100"
             class="w-full border p-2 mb-2 rounded"
             name="level{{ $i }}"
             value="{{ old('level'.$i, $equipo->{'level'.$i}) }}">
    </div>
  @endfor

  <button type="submit" class="btn">Actualizar Equipo</button>
</form>
@endsection
