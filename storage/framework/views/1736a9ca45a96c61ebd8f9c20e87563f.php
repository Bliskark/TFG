<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo $__env->yieldContent('title', 'PokeCombates'); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=VT323&family=Press+Start+2P&display=swap" rel="stylesheet">
  <link rel="icon" href="<?php echo e(asset('pokeball.png')); ?>" type="image/png">

  <style>
    :root {
      --pokedex-red: #e53e3e;
      --pokedex-dark-red: #c53030;
      --screen-color: #a0e9c0;
      --nav-hover: #ffd966;
      --nav-active: #ffcc33;
      /* Nuevo: Añadimos variables para los breakpoints */
      --mobile-breakpoint: 640px;
      --tablet-breakpoint: 768px;
    }
    
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'VT323', monospace;
      background-color: #f7fafc;
      overflow-x: hidden;
      -webkit-tap-highlight-color: transparent; /* Evita el resaltado al tocar en dispositivos móviles */
    }
    
    #app-container {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      width: 100%;
    }
    
    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      width: 100%;
    }
    
    .pokedex-content {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .title-font {
      font-family: 'Press Start 2P', cursive;
      text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }
    
    .pokedex-border {
      border: 8px solid #2d3748;
      border-radius: 12px;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .pokedex-screen {
      background-color: var(--screen-color);
      border: 4px solid #2d3748;
      border-radius: 8px;
      box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.2);
      flex: 1;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      /* Nuevo: mejor desplazamiento en dispositivos táctiles */
      -webkit-overflow-scrolling: touch;
    }
    
    .pokedex-btn {
      transition: all 0.2s;
      border: 2px solid rgba(0, 0, 0, 0.2);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      /* Nuevo: tamaño mínimo para botones en móvil */
      min-height: 44px;
      min-width: 44px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    
    .pokedex-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
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
    
    .led.green {
      background-color: #9ae6b4;
      box-shadow: 0 0 8px #48bb78;
    }
    
    .blue-orb {
      background: radial-gradient(#63b3ed, #3182ce);
      box-shadow: 0 0 15px #4299e1;
      border: 3px solid white;
    }
    
    .nav-link {
      color: white;
      position: relative;
      transition: all 0.2s;
      padding: 0.5rem 0.75rem;
      border-radius: 4px;
      /* Nuevo: mejor área táctil */
      min-height: 44px;
      display: inline-flex;
      align-items: center;
    }
    
    .nav-link:hover {
      color: #2d3748;
      background-color: var(--nav-hover);
      text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.5);
    }
    
    .nav-link:active {
      background-color: var(--nav-active);
      transform: translateY(1px);
    }
    
    .alert {
      background-color: var(--screen-color);
      border-left: 4px solid var(--pokedex-red);
      border-radius: 4px;
      padding: 1rem;
      margin-bottom: 1rem;
      font-family: 'VT323', monospace;
      font-size: 1.2rem;
      /* Nuevo: mejor visibilidad en dispositivos móviles */
      word-break: break-word;
    }
    
    .content-wrapper {
      flex: 1;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch; /* Mejora el scrolling en iOS */
      padding-bottom: 1rem; /* Espacio para evitar que el contenido quede debajo de elementos fijos */
    }
    
    /* Botones de acción */
    .action-btn {
      transition: all 0.2s;
      position: relative;
      overflow: hidden;
    }
    
    .action-btn:after {
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
    
    .action-btn:hover:after {
      opacity: 1;
    }
    
    .action-btn:active {
      transform: translateY(2px);
    }
    
    /* Botones de navegación móvil */
    #mobile-menu a {
      transition: all 0.2s;
      /* Nuevo: mejor área táctil */
      min-height: 44px;
      display: flex;
      align-items: center;
    }
    
    #mobile-menu a:hover {
      background-color: var(--nav-hover);
      color: #2d3748;
    }
    
    /* Nuevo: Animación del menú móvil */
    #mobile-menu {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
    }
    
    #mobile-menu.active {
      max-height: 500px;
    }
    
    /* Ajustes responsivos adicionales */
    @media (max-width: 768px) {
      .pokedex-border {
        border-width: 6px;
        margin: 0 8px;
      }
      
      .pokedex-screen {
        margin: 8px;
        padding: 12px;
      }
      
      .title-font {
        font-size: 0.9rem;
        letter-spacing: -0.5px; /* Ajuste para textos largos */
      }
      
      /* Nuevo: Espacio adicional para alertas en móvil */
      .alert {
        padding: 0.75rem;
        font-size: 1rem;
      }
    }
    
    @media (max-width: 640px) {
      .pokedex-border {
        border-width: 4px;
        margin: 0 4px;
      }
      
      .pokedex-screen {
        margin: 4px;
        padding: 8px;
      }
      
      /* Nuevo: Ajustes para botones y controles en pantallas muy pequeñas */
      .led {
        height: 8px;
        width: 8px;
      }
      
      .nav-link {
        padding: 0.4rem 0.6rem;
      }
      
      /* Nuevo: Reducción de márgenes para aprovechar espacio */
      .container {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
      }
    }
    
    /* Nuevo: Orientación landscape en móviles */
    @media (max-height: 500px) and (orientation: landscape) {
      .pokedex-border {
        border-width: 3px;
      }
      
      .pokedex-screen {
        margin: 3px;
        padding: 6px;
      }
      
      /* Ajustes para mejorar el uso del espacio horizontal */
      .container {
        max-width: 100%;
      }
      
      /* Controles más pequeños */
      .led {
        height: 6px;
        width: 6px;
      }
    }
    
    /* Nuevo: Accesibilidad mejorada - modo oscuro */
    @media (prefers-color-scheme: dark) {
      .pokedex-screen {
        background-color: #293942;
        color: #e2e8f0;
      }
      
      .alert {
        background-color: #1a202c;
        color: #e2e8f0;
      }
    }
    
    /* Nuevo: Soporte para dispositivos con notch */
    @supports (padding: max(0)) {
      .nav-container {
        padding-left: max(0.5rem, env(safe-area-inset-left));
        padding-right: max(0.5rem, env(safe-area-inset-right));
      }
      
      .content-wrapper {
        padding-bottom: max(1rem, env(safe-area-inset-bottom));
      }
    }
  </style>
</head>
<body>
  <div id="app-container">
    <!-- Barra de navegación estilo Pokédex -->
    <nav class="bg-red-600 text-white shadow-lg sticky top-0 z-10">
      <div class="container mx-auto p-2 sm:p-4 nav-container">
        <div class="flex justify-between items-center">
          <!-- Logo y nombre -->
          <div class="flex items-center space-x-2 sm:space-x-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full blue-orb flex items-center justify-center">
              <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-blue-300 animate-pulse"></div>
            </div>
            <a href="<?php echo e(route('home')); ?>" class="title-font text-lg sm:text-xl tracking-wide truncate max-w-xs">PokeCombates</a>
          </div>
          
          <!-- Luces indicadoras -->
          <div class="hidden md:flex space-x-3">
            <div class="led red"></div>
            <div class="led yellow"></div>
            <div class="led green"></div>
          </div>
          
          <!-- Menú de navegación desktop -->
          <div class="hidden md:flex items-center space-x-2 lg:space-x-4">
            <a href="<?php echo e(route('statistics')); ?>" class="nav-link font-medium text-sm lg:text-base">Estadísticas</a>
            <a href="<?php echo e(route('pokedex.index')); ?>" class="nav-link font-medium text-sm lg:text-base">Pokédex</a>
            <a href="<?php echo e(route('battle.show')); ?>" class="nav-link font-medium text-sm lg:text-base">Combatir</a>
            
            <?php if(auth()->guard()->check()): ?>
              <a href="<?php echo e(route('equipo.index')); ?>" class="nav-link font-medium text-sm lg:text-base">Equipo</a>
              <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-md pokedex-btn text-sm lg:text-base">
                  Logout
                </button>
              </form>
            <?php else: ?>
              <a href="<?php echo e(route('login')); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-md pokedex-btn action-btn text-sm lg:text-base">
                Login
              </a>
              <a href="<?php echo e(route('register')); ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 sm:px-4 sm:py-2 rounded-md pokedex-btn action-btn text-sm lg:text-base">
                Register
              </a>
            <?php endif; ?>
          </div>
          
          <!-- Botón para móvil -->
          <div class="md:hidden">
            <button id="mobile-menu-button" class="focus:outline-none p-2 hover:bg-red-700 rounded w-12 h-12 flex items-center justify-center">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>
        
        <!-- Menú móvil (mejorado con transiciones) -->
        <div id="mobile-menu" class="md:hidden mt-2 space-y-1 overflow-hidden">
          <a href="<?php echo e(route('statistics')); ?>" class="block py-3 px-4 hover:bg-yellow-300 hover:text-gray-800 rounded transition-all">Estadísticas</a>
          <a href="<?php echo e(route('pokedex.index')); ?>" class="block py-3 px-4 hover:bg-yellow-300 hover:text-gray-800 rounded transition-all">Pokédex</a>
          <a href="<?php echo e(route('battle.show')); ?>" class="block py-3 px-4 hover:bg-yellow-300 hover:text-gray-800 rounded transition-all">Combatir</a>
          
          <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('equipo.index')); ?>" class="block py-3 px-4 hover:bg-yellow-300 hover:text-gray-800 rounded transition-all">Equipo</a>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="block py-2">
              <?php echo csrf_field(); ?>
              <button type="submit" class="block w-full text-left px-4 py-3 bg-gray-800 text-white rounded hover:bg-gray-700 transition-all">
                Logout
              </button>
            </form>
          <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="block py-3 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition-all">Login</a>
            <a href="<?php echo e(route('register')); ?>" class="block py-3 px-4 bg-green-500 text-white rounded hover:bg-green-600 transition-all mt-2">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </nav>

    <!-- Alertas tipo Pokédex (mejoradas para móvil) -->
    <div class="container mx-auto px-2 sm:px-4 py-2">
      <?php if(session('success')): ?>
        <div class="alert bg-green-100 border-green-500 text-green-800">
          <div class="flex items-start">
            <span class="mr-2 flex-shrink-0">✓</span>
            <p class="flex-grow"><?php echo e(session('success')); ?></p>
            <button class="flex-shrink-0 ml-2 focus:outline-none text-green-800 hover:text-green-600" onclick="this.parentNode.parentNode.remove()">×</button>
          </div>
        </div>
      <?php endif; ?>

      <?php if(session('error')): ?>
        <div class="alert bg-red-100 border-red-500 text-red-800">
          <div class="flex items-start">
            <span class="mr-2 flex-shrink-0">❌</span>
            <p class="flex-grow"><?php echo e(session('error')); ?></p>
            <button class="flex-shrink-0 ml-2 focus:outline-none text-red-800 hover:text-red-600" onclick="this.parentNode.parentNode.remove()">×</button>
          </div>
        </div>
      <?php endif; ?>

      <?php if(session()->has('errors') && session('errors') instanceof \Illuminate\Support\ViewErrorBag): ?>
        <?php if(session('errors')->any()): ?>
          <div class="alert bg-red-100 border-red-500 text-red-800">
            <div class="flex items-start">
              <span class="mr-2 flex-shrink-0">❌</span>
              <p class="flex-grow"><?php echo e(session('errors')->first()); ?></p>
              <button class="flex-shrink-0 ml-2 focus:outline-none text-red-800 hover:text-red-600" onclick="this.parentNode.parentNode.remove()">×</button>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <!-- Contenido principal estilo Pokédex -->
    <main class="container mx-auto px-2 sm:px-4 py-2 flex-1 flex flex-col">
      <div class="pokedex-border bg-red-500 flex-1 flex flex-col">
        <div class="pokedex-screen m-2 sm:m-4 p-3 sm:p-6 flex-1 flex flex-col">
          <div class="mb-2 sm:mb-4 flex justify-between items-center">
            <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 truncate"><?php echo $__env->yieldContent('title', 'PokeCombates'); ?></h1>
            <div class="flex space-x-2">
              <div class="led red"></div>
              <div class="led yellow"></div>
            </div>
          </div>
          <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>
        
        <!-- Controles inferiores de la Pokédex (mejorados para táctil) -->
        <div class="p-2 sm:p-4 flex justify-center space-x-2 sm:space-x-4">
          <button class="bg-gray-800 w-8 h-8 sm:w-12 sm:h-12 rounded-full focus:outline-none hover:bg-gray-700 active:bg-gray-900 transition-colors"></button>
          <div class="flex flex-col space-y-1 sm:space-y-2">
            <div class="flex space-x-1 sm:space-x-2">
              <button class="bg-gray-800 w-4 h-4 sm:w-6 sm:h-6 rounded-sm focus:outline-none hover:bg-gray-700 active:bg-gray-900 transition-colors"></button>
              <button class="bg-gray-800 w-4 h-4 sm:w-6 sm:h-6 rounded-sm focus:outline-none hover:bg-gray-700 active:bg-gray-900 transition-colors"></button>
            </div>
            <div class="flex space-x-1 sm:space-x-2">
              <button class="bg-gray-800 w-4 h-4 sm:w-6 sm:h-6 rounded-sm focus:outline-none hover:bg-gray-700 active:bg-gray-900 transition-colors"></button>
              <button class="bg-gray-800 w-4 h-4 sm:w-6 sm:h-6 rounded-sm focus:outline-none hover:bg-gray-700 active:bg-gray-900 transition-colors"></button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Toggle para el menú móvil (mejorado con animaciones)
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('active');
    });
    
    // Cerrar menú móvil al hacer clic en un enlace
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    mobileLinks.forEach(link => {
      link.addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.remove('active');
      });
    });
    
    // Parpadeo de los LEDs
    setInterval(function() {
      const leds = document.querySelectorAll('.led');
      const randomLed = leds[Math.floor(Math.random() * leds.length)];
      randomLed.style.opacity = '0.5';
      setTimeout(function() {
        randomLed.style.opacity = '1';
      }, 300);
    }, 2000);
    
    // Reemplazar los alerts de JavaScript con nuestras alertas estilizadas
    const originalAlert = window.alert;
    window.alert = function(message) {
      const alertContainer = document.createElement('div');
      alertContainer.className = 'fixed top-4 right-4 alert bg-yellow-100 border-yellow-500 text-yellow-800 z-50 w-64 sm:w-80 transition-all opacity-0';
      alertContainer.style.transform = 'translateY(-20px)';
      alertContainer.innerHTML = `
        <div class="flex items-center">
          <span class="mr-2 flex-shrink-0">ℹ️</span>
          <p class="flex-grow">${message}</p>
          <button class="flex-shrink-0 ml-2 focus:outline-none text-yellow-800 hover:text-yellow-600" onclick="this.parentNode.parentNode.remove()">×</button>
        </div>
      `;
      document.body.appendChild(alertContainer);
      
      // Animación de entrada
      setTimeout(function() {
        alertContainer.style.opacity = '1';
        alertContainer.style.transform = 'translateY(0)';
      }, 10);
      
      // Auto-remove después de 5 segundos
      setTimeout(function() {
        alertContainer.style.opacity = '0';
        alertContainer.style.transform = 'translateY(-20px)';
        setTimeout(function() {
          alertContainer.remove();
        }, 300);
      }, 5000);
    };

    // Asegurarse de que la pantalla ocupe toda la altura disponible
    function adjustHeight() {
      const vh = window.innerHeight * 0.01;
      document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
    
    // Ejecutar al cargar y al cambiar el tamaño de la ventana
    window.addEventListener('load', adjustHeight);
    window.addEventListener('resize', adjustHeight);
    
    // Efecto de "presionado" para botones
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
      
      // Soporte para eventos táctiles
      button.addEventListener('touchstart', function(e) {
        this.style.transform = 'translateY(2px)';
        this.style.boxShadow = 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.2)';
      }, {passive: true});
      
      button.addEventListener('touchend', function() {
        this.style.transform = '';
        this.style.boxShadow = '';
      });
    });
    
    // Detectar si estamos en un dispositivo móvil
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    
    if (isMobile) {
      // Ajustes específicos para móviles
      document.body.classList.add('mobile-device');
      
      // Prevenir el zoom en doble toque en los botones de acción
      const actionButtons = document.querySelectorAll('.action-btn, .nav-link, button');
      actionButtons.forEach(button => {
        button.addEventListener('touchend', function(e) {
          e.preventDefault();
          // Simular un clic después de un pequeño retraso para mejorar la retroalimentación táctil
          setTimeout(() => {
            if (this.tagName === 'A' && this.href) {
              window.location.href = this.href;
            } else if (this.type === 'submit') {
              this.form.submit();
            }
          }, 150);
        });
      });
    }
    
    // Desactivar alertas después de 5 segundos
    const staticAlerts = document.querySelectorAll('.alert');
    staticAlerts.forEach(alert => {
      setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.height = '0';
        alert.style.margin = '0';
        alert.style.padding = '0';
        alert.style.overflow = 'hidden';
        
        setTimeout(() => {
          alert.remove();
        }, 300);
      }, 5000);
    });
  </script>
</body>
</html><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/layouts/app.blade.php ENDPATH**/ ?>