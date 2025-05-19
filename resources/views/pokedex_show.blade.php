@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-4 bg-white shadow rounded">
  <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="mx-auto mb-4">
  <h2 class="text-2xl font-bold mb-2">{{ ucfirst($pokemon['name']) }}</h2>
  <p class="mb-4">{{ $description }}</p>
  <h3 class="font-semibold">Stats:</h3>
  <ul class="list-disc list-inside">
    @foreach($pokemon['stats'] as $stat)
      <li>{{ ucfirst($stat['stat']['name']) }}: {{ $stat['base_stat'] }}</li>
    @endforeach
  </ul>
</div>
@endsection