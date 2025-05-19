

<?php $__env->startSection('title', 'PC de ' . (Auth::check() ? Auth::user()->email : 'Alguien')); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col items-center justify-center min-h-full py-4">
    <div class="w-full max-w-md bg-red-600 rounded-lg shadow-xl overflow-hidden border-6 border-gray-800">
        <!-- Parte superior de la Pokédex -->
        <div class="bg-red-600 p-4 flex items-center justify-between border-b-6 border-gray-800">
            <div class="w-14 h-14 rounded-full blue-orb flex items-center justify-center">
                <div class="w-10 h-10 rounded-full bg-blue-300 animate-pulse"></div>
            </div>
            <div class="flex space-x-3">
                <div class="led red"></div>
                <div class="led yellow"></div>
                <div class="led green"></div>
            </div>
        </div>
        
        <!-- Pantalla principal -->
        <div class="pokedex-screen m-4 p-5 rounded-lg border-4 border-gray-800">
            <div class="flex flex-col space-y-3">
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="pokedex-btn bg-blue-500 action-btn">
                        Iniciar Sesión
                    </a>
                <?php endif; ?>
                
                <a href="<?php echo e(route('statistics')); ?>" class="pokedex-btn bg-green-500 action-btn">
                    Estadísticas
                </a>
                
                <a href="<?php echo e(route('pokedex.index')); ?>" class="pokedex-btn bg-red-500 action-btn">
                    Pokédex
                </a>
                
                <a href="<?php echo e(route('equipo.index')); ?>" class="pokedex-btn bg-yellow-500 action-btn">
                    Equipo
                </a>
                
                <a href="<?php echo e(route('battle.show')); ?>" class="pokedex-btn bg-purple-500 action-btn">
                    Combatir
                </a>
                
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->rol === 'admin'): ?>
                        <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="pokedex-btn bg-gray-800 action-btn text-white">
                            Panel de Administración
                        </a>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="pokedex-btn bg-red-600 w-full">
                            Cerrar Sesión
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Parte inferior de la Pokédex -->
        <div class="bg-red-600 p-4 flex justify-center space-x-2">
            <div class="bg-gray-800 w-12 h-12 rounded-full"></div>
            <div class="flex flex-col space-y-2">
                <div class="flex space-x-2">
                    <div class="bg-gray-800 w-6 h-6 rounded-sm"></div>
                    <div class="bg-gray-800 w-6 h-6 rounded-sm"></div>
                </div>
                <div class="flex space-x-2">
                    <div class="bg-gray-800 w-6 h-6 rounded-sm"></div>
                    <div class="bg-gray-800 w-6 h-6 rounded-sm"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .pokedex-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem;
        border-radius: 0.5rem;
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
    
    .blue-orb {
        background: radial-gradient(#63b3ed, #3182ce);
        box-shadow: 0 0 15px #4299e1;
        border: 3px solid white;
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
    
    .pokedex-screen {
        background-color: #a0e9c0;
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.2);
    }
    
    .title-font {
        font-family: 'Press Start 2P', cursive;
        text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/home.blade.php ENDPATH**/ ?>