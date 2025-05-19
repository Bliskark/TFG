@extends('layouts.app')

@section('title', 'Estadísticas')

@section('content')
<h1 class="text-2xl font-bold mb-6">📊 Estadísticas Generales</h1>

<h2 class="text-xl font-semibold mt-6 mb-2">🔥 Top 10 Pokémon más usados</h2>
<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
  @foreach($topPokemons as $p)
  <div class="bg-white rounded shadow p-3 flex flex-col items-center text-center">
    <img src="{{ $p->image }}" alt="{{ $p->name }}" class="w-20 h-20 mb-2">
    <div class="font-semibold text-lg">{{ $p->name }}</div>
    <div class="text-sm text-gray-600">Usado {{ $p->cnt }} veces</div>
  </div>
  @endforeach
</div>

<h2 class="text-xl font-semibold mt-10 mb-2">🏆 Top 5 Entrenadores</h2>
<table class="min-w-full bg-white border rounded shadow">
  <thead class="bg-gray-100">
    <tr>
      <th class="py-2 px-4 text-left">Email</th>
      <th class="py-2 px-4 text-left">Victorias</th>
    </tr>
  </thead>
  <tbody>
    @foreach($topUsers as $u)
    <tr class="border-t hover:bg-gray-50">
      <td class="py-2 px-4">{{ $u->email }}</td>
      <td class="py-2 px-4 font-bold">{{ $u->victories }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
