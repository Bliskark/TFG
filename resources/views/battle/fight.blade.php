@extends('layouts.app')

@section('title', 'Batalla Pokémon')

@section('content')
@php $b = session('battle'); @endphp

<div class="max-w-5xl mx-auto px-4 md:px-0 py-6 grid grid-cols-1 md:grid-cols-2 gap-8">
  {{-- Campo de batalla --}}
  <div class="relative h-96 rounded-xl shadow-2xl overflow-hidden bg-gradient-to-b from-blue-400 to-blue-700">
    {{-- Césped --}}
    <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-green-900 to-green-700 opacity-90"></div>

    {{-- Enemigo --}}
    <div class="absolute top-4 right-8 flex flex-col items-center space-y-2">
      <div class="bg-white bg-opacity-80 rounded-lg p-3 shadow-lg w-64">
        <div class="flex justify-between items-baseline">
          <h3 class="text-xl font-bold text-gray-800 truncate">{{ ucfirst($b['enemy']['name']) }}</h3>
          <span class="text-sm font-semibold text-gray-700">Nv. {{ $b['enemy']['level'] }}</span>
        </div>
        <div class="mt-2">
          <div class="relative w-full h-4 bg-gray-300 rounded-full border border-gray-500 overflow-hidden">
            <div class="absolute inset-0 transition-all duration-300"
                 style="width: {{ $b['enemy']['hp'] / $b['enemy']['hp_max'] * 100 }}%; background-color: {{ $b['enemy']['hp'] / $b['enemy']['hp_max'] > 0.5 ? '#48bb78' : ($b['enemy']['hp'] / $b['enemy']['hp_max'] > 0.25 ? '#ecc94b' : '#f56565') }};">
            </div>
          </div>
          <p class="text-xs text-right text-gray-600 mt-1">{{ $b['enemy']['hp'] }} / {{ $b['enemy']['hp_max'] }} HP</p>
        </div>
      </div>
      <img src="{{ $b['enemy']['sprite'] }}" alt="{{ $b['enemy']['name'] }}"
           class="w-32 h-32 pixelated animate-battle-hover" />
    </div>

    {{-- Jugador --}}
    <div class="absolute bottom-4 left-8 flex flex-col items-center space-y-2">
      <img src="{{ $b['player']['sprite'] }}" alt="{{ $b['player']['name'] }}"
           class="w-36 h-36 pixelated animate-battle-bounce" />
      <div class="bg-white bg-opacity-80 rounded-lg p-3 shadow-lg w-64">
        <div class="flex justify-between items-baseline">
          <h3 class="text-xl font-bold text-gray-800 truncate">{{ ucfirst($b['player']['name']) }}</h3>
          <span class="text-sm font-semibold text-gray-700">Nv. {{ $b['player']['level'] }}</span>
        </div>
        <div class="mt-2">
          <div class="relative w-full h-4 bg-gray-300 rounded-full border border-gray-500 overflow-hidden">
            <div class="absolute inset-0 transition-all duration-300"
                 style="width: {{ $b['player']['hp'] / $b['player']['hp_max'] * 100 }}%; background-color: {{ $b['player']['hp'] / $b['player']['hp_max'] > 0.5 ? '#48bb78' : ($b['player']['hp'] / $b['player']['hp_max'] > 0.25 ? '#ecc94b' : '#f56565') }};">
            </div>
          </div>
          <p class="text-xs text-right text-gray-600 mt-1">{{ $b['player']['hp'] }} / {{ $b['player']['hp_max'] }} HP</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Panel de diálogo y acciones --}}
  <div class="bg-white rounded-xl shadow-xl p-6 flex flex-col justify-between">
    {{-- Turno e info --}}
    <h2 class="text-lg font-bold text-gray-800 mb-4">
      Turno: <span class="text-blue-600">{{ ucfirst($b['turn']) }}</span>
      &mdash; Rival: <span class="font-semibold text-gray-700">{{ ucfirst($b['type']) }}</span>
    </h2>

    {{-- Registro de batalla --}}
    <div class="bg-gray-100 p-4 rounded-lg border border-gray-300 max-h-48 overflow-auto mb-6">
      <ul class="space-y-1 text-gray-700 text-sm">
        @foreach($b['log'] as $msg)
          <li class="px-3 py-2 {{ $loop->even ? 'bg-gray-200 rounded' : '' }}">{{ $msg }}</li>
        @endforeach
      </ul>
    </div>

    {{-- Menú de acciones --}}
    @if($b['turn'] === 'player')
      <form action="{{ route('battle.action') }}" method="POST" class="grid grid-cols-2 gap-4">
        @csrf
        <button name="action" value="atk"  class="action-btn bg-red-500 hover:bg-red-600 disabled:opacity-50">ATACAR</button>
        <button name="action" value="spc"  class="action-btn bg-purple-500 hover:bg-purple-600 disabled:opacity-50">AT. ESPECIAL</button>
        <button name="action" value="def"  class="action-btn bg-blue-500 hover:bg-blue-600 disabled:opacity-50">DEFENDER</button>
        <button name="action" value="sdef" class="action-btn bg-teal-500 hover:bg-teal-600 disabled:opacity-50">DEF. ESPECIAL</button>
        <button name="action" value="heal" class="action-btn bg-green-500 hover:bg-green-600 col-span-2 disabled:opacity-50">CURAR</button>
      </form>
    @else
      <div class="text-center py-4">
        <p class="text-gray-600 italic">¡Es el turno de {{ ucfirst($b['enemy']['name']) }}!</p>
      </div>
    @endif
  </div>
</div>
@endsection

@push('styles')
<style>
  .pixelated {
    image-rendering: pixelated;
    image-rendering: crisp-edges;
  }
  @keyframes battle-hover {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
  }
  @keyframes battle-bounce {
    0%,100% { transform: translateY(0) scaleY(1); }
    30% { transform: translateY(-12px) scaleY(1.05); }
    60% { transform: translateY(0) scaleY(0.95); }
    80% { transform: translateY(-6px) scaleY(1.02); }
  }
  .animate-battle-hover {
    animation: battle-hover 3s ease-in-out infinite;
  }
  .animate-battle-bounce {
    animation: battle-bounce 4s ease-in-out infinite;
  }
  .action-btn {
    @apply py-3 px-6 text-white font-bold rounded-xl shadow-md border-2 border-transparent transition duration-200;
  }
</style>
@endpush
