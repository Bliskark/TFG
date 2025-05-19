@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="max-w-2xl mx-auto p-2">
  <!-- Contenedor principal estilo Pokédex -->
  <div class="bg-red-600 rounded-lg shadow-lg p-4 border-4 border-gray-800">
    <!-- Luces decorativas superiores estilo Pokédex -->
    <div class="flex items-center mb-4">
      <div class="h-10 w-10 rounded-full bg-blue-400 border-4 border-white animate-pulse shadow-inner"></div>
      <div class="flex ml-2 space-x-2">
        <div class="h-4 w-4 rounded-full bg-red-400 border border-red-700"></div>
        <div class="h-4 w-4 rounded-full bg-yellow-400 border border-yellow-700"></div>
        <div class="h-4 w-4 rounded-full bg-green-400 border border-green-700"></div>
      </div>
      <h1 class="text-2xl font-bold ml-auto text-white tracking-wider">REGISTRAR ENTRENADOR</h1>
    </div>

    <!-- Pantalla principal -->
    <div class="bg-gray-100 rounded-lg p-5 border-2 border-gray-800">
      <!-- Errores de validación -->
      @if(is_array(session('errors')) && count(session('errors')) > 0)
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded border border-red-400">
          <div class="flex items-center mb-1">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="font-bold">ERRORES DETECTADOS:</span>
          </div>
          <ul class="list-disc list-inside">
            @foreach(session('errors') as $msg)
              <li>{{ $msg }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.usuarios.store') }}" method="POST">
        @csrf

        <!-- EMAIL -->
        <div class="mb-4 bg-blue-100 p-4 rounded-lg border-2 border-blue-400">
          <label for="email" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">EMAIL</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}"
                 class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                 required>
        </div>

        <!-- PASSWORD -->
        <div class="mb-4 bg-gray-100 p-4 rounded-lg border-2 border-gray-400">
          <label for="password" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">CONTRASEÑA</label>
          <input type="password" name="password" id="password"
                 class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                 required>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="mb-4 bg-gray-100 p-4 rounded-lg border-2 border-gray-400">
          <label for="password_confirmation" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">CONFIRMAR CONTRASEÑA</label>
          <input type="password" name="password_confirmation" id="password_confirmation"
                 class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                 required>
        </div>

        <!-- ROL -->
        <div class="mb-4 bg-purple-100 p-4 rounded-lg border-2 border-purple-400">
          <label for="rol" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">CLASE DE ENTRENADOR</label>
          <select name="rol" id="rol" required
                  class="w-full border-2 border-gray-400 bg-white rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300">
            <option value="">-- Selecciona --</option>
            <option value="admin"      {{ old('rol')==='admin'      ? 'selected' : '' }}>Admin</option>
            <option value="lider"      {{ old('rol')==='lider'      ? 'selected' : '' }}>Líder de Gimnasio</option>
            <option value="alto_mando" {{ old('rol')==='alto_mando' ? 'selected' : '' }}>Alto Mando</option>
            <option value="campeon"    {{ old('rol')==='campeon'    ? 'selected' : '' }}>Campeón</option>
            <option value="user"       {{ old('rol')==='user'       ? 'selected' : '' }}>Entrenador</option>
          </select>
        </div>

        <!-- ESTADÍSTICAS -->
        <div class="mb-4">
          <div class="bg-yellow-100 p-3 rounded-t-lg border-2 border-b-0 border-yellow-400">
            <div class="flex items-center">
              <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
              </svg>
              <span class="text-gray-800 font-bold uppercase tracking-wider">ESTADÍSTICAS DE COMBATE</span>
            </div>
          </div>
          
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 bg-gray-100 rounded-b-lg border-2 border-yellow-400">
            <div>
              <label for="victories" class="flex items-center text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">
                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>Victorias
              </label>
              <input type="number" name="victories" id="victories" min="0"
                     value="{{ old('victories', 0) }}"
                     class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 bg-white">
            </div>
            <div>
              <label for="defeats" class="flex items-center text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">
                <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>Derrotas
              </label>
              <input type="number" name="defeats" id="defeats" min="0"
                     value="{{ old('defeats', 0) }}"
                     class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 bg-white">
            </div>
            <div>
              <label for="streak" class="flex items-center text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">
                <span class="inline-block w-3 h-3 bg-blue-500 rounded-full mr-2"></span>Racha
              </label>
              <input type="number" name="streak" id="streak" min="0"
                     value="{{ old('streak', 0) }}"
                     class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 bg-white">
            </div>
          </div>
        </div>

        <!-- DECORATIVE LINES -->
        <div class="flex items-center my-4">
          <div class="h-2 flex-grow bg-gray-300 rounded"></div>
          <div class="mx-2 w-8 h-8 rounded-full border-2 border-gray-800 bg-gray-300 flex items-center justify-center">
            <div class="w-4 h-4 rounded-full bg-gray-600"></div>
          </div>
          <div class="h-2 flex-grow bg-gray-300 rounded"></div>
        </div>

        <!-- ACTIONS -->
        <div class="flex justify-between items-center">
          <a href="{{ route('admin.usuarios.index') }}" class="text-blue-700 hover:underline flex items-center">
            <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Regresar
          </a>
          <button type="submit"
                  class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-md transform hover:scale-105 transition-transform duration-200 border-2 border-gray-800 flex items-center">
            <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
              <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
            </svg>
            REGISTRAR
          </button>
        </div>
      </form>
    </div>

    <!-- Detalles decorativos inferiores -->
    <div class="flex justify-between items-center mt-3">
      <div class="h-6 w-12 rounded-lg bg-gray-800"></div>
      <div class="h-3 w-20 rounded bg-gray-800"></div>
      <div class="h-6 w-12 rounded-lg bg-gray-800"></div>
    </div>
  </div>
</div>
@endsection
