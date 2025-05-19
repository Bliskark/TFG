@extends('layouts.app')

@section('title', 'Usuarios y Eventos')

@section('content')
<div class="bg-gray-800 p-3 rounded-t-lg flex items-center space-x-2 border-b-2 border-gray-700">
  <div class="led red"></div>
  <div class="led yellow"></div>
  <h1 class="text-xl sm:text-2xl font-bold text-gray-100 title-font flex-grow">Usuarios</h1>
  <a href="{{ route('admin.usuarios.create') }}" class="pokedex-btn bg-indigo-600 text-sm px-3">
    + Crear Usuario
  </a>
  <div class="w-8 h-8 rounded-full blue-orb flex items-center justify-center">
    <div class="w-4 h-4 rounded-full bg-blue-300 animate-pulse"></div>
  </div>
</div>

{{-- LISTADO DE USUARIOS --}}
<div class="p-4">
  <table class="w-full border-collapse">
    <thead>
      <tr class="bg-gray-200 border-b-2 border-gray-300">
        <th class="py-2 px-3 text-left text-gray-700 font-bold text-lg">Email</th>
        <th class="py-2 px-3 text-left text-gray-700 font-bold text-lg">Rol</th>
        <th class="py-2 px-3 text-left text-gray-700 font-bold text-lg">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($usuarios as $u)
      <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-150">
        <td class="py-3 px-3 text-base">{{ $u->email }}</td>
        <td class="py-3 px-3">
          <span class="px-2 py-1 border-2 text-sm font-bold
            @if($u->rol == 'admin') bg-red-100 text-red-800 border-red-400
            @elseif($u->rol == 'lider') bg-green-100 text-green-800 border-green-400
            @elseif($u->rol == 'alto_mando') bg-purple-100 text-purple-800 border-purple-400
            @elseif($u->rol == 'campeon') bg-yellow-100 text-yellow-800 border-yellow-400
            @else bg-blue-100 text-blue-800 border-blue-400
            @endif">
            {{ $u->rol }}
          </span>
        </td>
        <td class="py-3 px-3">
          <div class="flex space-x-2">
            <a href="{{ route('admin.usuarios.edit', $u->id) }}" class="pokedex-btn bg-blue-500 text-sm px-3">Editar</a>
            <a href="{{ route('admin.usuarios.equipo', $u->id) }}" class="pokedex-btn bg-green-500 text-sm px-3">Equipo</a>
            <form action="{{ route('admin.usuarios.destroy', $u->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?')" class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="pokedex-btn bg-red-600 text-sm px-3">Borrar</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{-- Total de Usuarios --}}
  <div class="mt-4 text-right text-gray-700">
    <span>Total de usuarios: {{ count($usuarios) }}</span>
  </div>
</div>

{{-- LISTADO DE EVENTOS --}}
<div class="mt-10 p-4 bg-white rounded-lg shadow">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Eventos</h2>
    <a href="{{ route('admin.eventos.create') }}" class="pokedex-btn bg-yellow-600 text-sm px-3">
      + Crear Evento
    </a>
  </div>

  <table class="w-full border-collapse mb-4">
    <thead>
      <tr class="bg-yellow-200 border-b-2 border-yellow-400">
        <th class="py-2 px-3 text-left text-gray-800 font-bold">Nombre</th>
        <th class="py-2 px-3 text-left text-gray-800 font-bold">Descripción</th>
        <th class="py-2 px-3 text-left text-gray-800 font-bold">Fecha</th>
        <th class="py-2 px-3 text-left text-gray-800 font-bold">Tipo</th>
        <th class="py-2 px-3 text-left text-gray-800 font-bold">Efecto</th>
        <th class="py-2 px-3 text-left text-gray-800 font-bold">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($eventos as $evento)
      <tr class="border-b border-yellow-300 hover:bg-yellow-100 transition duration-150">
        <td class="py-3 px-3">{{ $evento->name }}</td>
        <td class="py-3 px-3">{{ $evento->description }}</td>
        <td class="py-3 px-3">{{ $evento->created_at->format('d/m/Y') }}</td>
        <td class="py-3 px-3">{{ $evento->tipo }}</td>
        <td class="py-3 px-3">{{ $evento->efecto }}</td>
        <td class="py-3 px-3">
          <div class="flex space-x-2">
            <a href="{{ route('admin.eventos.edit', $evento->id) }}" class="pokedex-btn bg-yellow-500 text-sm px-3">Editar</a>
            <form action="{{ route('admin.eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este evento?')" class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="pokedex-btn bg-red-600 text-sm px-3">Borrar</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{-- Total de Eventos --}}
  <div class="mt-4 text-right text-gray-700">
    <span>Total de eventos: {{ count($eventos) }}</span>
  </div>
</div>

<div class="mt-4 p-2 flex justify-center space-x-4">
  <div class="flex space-x-2">
    <div class="bg-gray-800 w-6 h-6 rounded-sm"></div>
    <div class="bg-gray-800 w-6 h-6 rounded-sm"></div>
  </div>
</div>

<style>
  .title-font {
    font-family: 'Press Start 2P', cursive;
    text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.3);
    letter-spacing: 1px;
    font-size: 1.4rem;
  }
  
  .pokedex-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    color: white;
    font-weight: bold;
    transition: all 0.2s;
    border: 2px solid rgba(0, 0, 0, 0.2);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    position: relative;
    overflow: hidden;
  }
  
  .pokedex-btn:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    opacity: 0;
    transition: opacity 0.3s;
  }
  
  .pokedex-btn:hover:after {
    opacity: 1;
  }
  
  .pokedex-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  }
  
  .pokedex-btn:active {
    transform: translateY(0);
    box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.2);
  }
  
  .led {
    height: 12px;
    width: 12px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    transition: all 0.3s;
  }
  
  .led.red {
    background-color: #fc8181;
    box-shadow: 0 0 8px #f56565;
  }
  
  .led.yellow {
    background-color: #faf089;
    box-shadow: 0 0 8px #ecc94b;
  }
  
  .blue-orb {
    background: radial-gradient(#63b3ed, #3182ce);
    box-shadow: 0 0 10px #4299e1;
    border: 2px solid white;
  }
</style>

<script>
  // Parpadeo aleatorio de los LEDs
  setInterval(function() {
    const leds = document.querySelectorAll('.led');
    const randomLed = leds[Math.floor(Math.random() * leds.length)];
    randomLed.style.opacity = '0.5';
    setTimeout(function() {
      randomLed.style.opacity = '1';
    }, 300);
  }, 2000);
  
  // Efecto de presionado para botones
  const buttons = document.querySelectorAll('.pokedex-btn');
  buttons.forEach(button => {
    button.addEventListener('mousedown', function() {
      this.style.transform = 'translateY(2px)';
      this.style.boxShadow = 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.2)';
    });
    
    button.addEventListener('mouseup', function() {
      this.style.transform = '';
      this.style.boxShadow = '';
    });
    
    button.addEventListener('mouseleave', function() {
      this.style.transform = '';
      this.style.boxShadow = '';
    });
  });
</script>
@endsection