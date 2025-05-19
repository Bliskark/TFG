@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="bg-gray-800 p-3 rounded-t-lg flex items-center space-x-2 border-b-2 border-gray-700">
  <div class="led red"></div>
  <div class="led yellow"></div>
  <h1 class="text-xl sm:text-2xl font-bold text-gray-100 title-font flex-grow">Editar Usuario</h1>
  <div class="w-8 h-8 rounded-full blue-orb flex items-center justify-center">
    <div class="w-4 h-4 rounded-full bg-blue-300 animate-pulse"></div>
  </div>
</div>

<form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" class="space-y-5 p-4">
  @csrf
  @method('PUT')

  <div class="pokedex-input-group">
    <label class="pokedex-label">Email</label>
    <div class="pokedex-input-wrapper">
      <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
            class="pokedex-input" required>
    </div>
  </div>

  <div class="pokedex-input-group">
    <label class="pokedex-label">Rol</label>
    <div class="pokedex-input-wrapper">
      <select name="rol" class="pokedex-select">
        <option value="entrenador" @if($usuario->rol==='entrenador') selected @endif>Entrenador</option>
        <option value="lider" @if($usuario->rol==='lider') selected @endif>Líder</option>
        <option value="alto_mando" @if($usuario->rol==='alto_mando') selected @endif>Alto Mando</option>
        <option value="campeon" @if($usuario->rol==='campeon') selected @endif>Campeón</option>
        <option value="admin" @if($usuario->rol==='admin') selected @endif>Admin</option>
      </select>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="pokedex-input-group">
      <label class="pokedex-label">Victorias</label>
      <div class="pokedex-input-wrapper">
        <input type="number" name="victories" value="{{ old('victories', $usuario->victories) }}"
              class="pokedex-input" min="0">
      </div>
    </div>

    <div class="pokedex-input-group">
      <label class="pokedex-label">Derrotas</label>
      <div class="pokedex-input-wrapper">
        <input type="number" name="defeats" value="{{ old('defeats', $usuario->defeats) }}"
              class="pokedex-input" min="0">
      </div>
    </div>

    <div class="pokedex-input-group">
      <label class="pokedex-label">Racha</label>
      <div class="pokedex-input-wrapper">
        <input type="number" name="streak" value="{{ old('streak', $usuario->streak) }}"
              class="pokedex-input" min="0">
      </div>
    </div>
  </div>

  <div class="flex items-center justify-between pt-4 border-t border-gray-300">
    <a href="{{ route('admin.usuarios.index') }}" class="pokedex-btn bg-gray-600 action-btn">
      Volver
    </a>
    <button type="submit" class="pokedex-btn bg-blue-500 action-btn">Actualizar Usuario</button>
  </div>
</form>

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
    font-size: 1.1rem;
  }
  
  .pokedex-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
    color: #2d3748;
    font-size: 1rem;
  }
  
  .pokedex-input-wrapper {
    position: relative;
    border: 2px solid #2d3748;
    border-radius: 0.375rem;
    background-color: white;
    overflow: hidden;
  }
  
  .pokedex-input, .pokedex-select {
    width: 100%;
    padding: 0.625rem;
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    outline: none;
    font-size: 1rem;
    color: #2d3748;
    transition: all 0.2s;
  }
  
  .pokedex-input:focus, .pokedex-select:focus {
    box-shadow: inset 0 0 0 2px #3182ce;
  }
  
  .pokedex-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.625rem 1.25rem;
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