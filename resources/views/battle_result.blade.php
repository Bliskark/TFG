@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Resultado del Combate</h1>

@if(session('evento'))
  <div class="p-4 bg-gray-100 rounded">
    <h2 class="font-semibold">Evento: {{ session('evento')->name }}</h2>
    <p>{{ session('evento')->description }}</p>
  </div>
@endif

<a href="{{ route('equipo.index') }}" class="mt-6 inline-block btn">Ver Mi Equipo</a>
@endsection