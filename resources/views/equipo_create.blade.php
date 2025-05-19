@extends('layouts.app')

@section('content')
<h1>Crear Equipo</h1>

<form action="{{ route('equipo.store') }}" method="POST">
    @csrf
    @for($i = 1; $i <= 6; $i++)
        <div>
            <label for="pokemon{{ $i }}">Pokémon {{ $i }}:</label>
            <select name="pokemon{{ $i }}_name" id="pokemon{{ $i }}">
                <option value="">-- Selecciona un Pokémon --</option>
                @foreach($pokemons as $poke)
                    <option value="{{ $poke['name'] }}">{{ ucfirst($poke['name']) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="level{{ $i }}">Nivel:</label>
            <input type="number" name="level{{ $i }}" id="level{{ $i }}" min="1" max="100" value="1">
        </div>
    @endfor
    <button type="submit">Guardar Equipo</button>
</form>
@endsection
