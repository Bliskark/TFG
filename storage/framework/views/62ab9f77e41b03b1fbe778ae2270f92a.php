

<?php $__env->startSection('title', 'Editar Evento'); ?>

<?php $__env->startSection('content'); ?>
  <div class="max-w-3xl mx-auto bg-white bg-opacity-90 rounded-xl shadow-lg border-2 border-gray-700 overflow-hidden">
    <!-- Header estilo Pokédex -->
    <div class="bg-red-600 text-white py-3 px-4 flex items-center justify-between border-b-2 border-gray-700">
      <div class="flex items-center">
        <div class="w-6 h-6 rounded-full bg-blue-500 border-2 border-white mr-3 animate-pulse"></div>
        <h1 class="title-font text-xl">Editar Evento</h1>
      </div>
      <div class="flex space-x-2">
        <div class="led red"></div>
        <div class="led yellow"></div>
      </div>
    </div>

    <form action="<?php echo e(route('admin.eventos.update', $evento->id)); ?>" method="POST" class="p-4 sm:p-6">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <!-- Campo de nombre -->
      <div class="mb-5">
        <label for="name" class="block font-bold text-lg mb-2 text-gray-800">Nombre del Evento:</label>
        <div class="relative">
          <input type="text" name="name" id="name"
                value="<?php echo e(old('name', $evento->name)); ?>"
                class="w-full border-2 border-gray-700 rounded-lg p-3 bg-green-100 focus:bg-green-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
          <div class="absolute right-3 top-3">
            <div class="w-3 h-3 rounded-full bg-gray-500"></div>
          </div>
        </div>
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <p class="text-red-600 font-medium mt-1 flex items-center">
            <span class="mr-1">!</span>
            <?php echo e($message); ?>

          </p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <!-- Campo de descripción -->
      <div class="mb-5">
        <label for="description" class="block font-bold text-lg mb-2 text-gray-800">Descripción:</label>
        <div class="relative">
          <textarea name="description" id="description" rows="4"
                    class="w-full border-2 border-gray-700 rounded-lg p-3 bg-green-100 focus:bg-green-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description', $evento->description)); ?></textarea>
          <div class="absolute right-3 top-3">
            <div class="w-3 h-3 rounded-full bg-gray-500"></div>
          </div>
        </div>
        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <p class="text-red-600 font-medium mt-1 flex items-center">
            <span class="mr-1">!</span>
            <?php echo e($message); ?>

          </p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <!-- Campo de tipo -->
      <div class="mb-5">
        <label for="tipo" class="block font-bold text-lg mb-2 text-gray-800">Tipo de Evento:</label>
        <div class="relative">
          <select name="tipo" id="tipo"
                  class="w-full border-2 border-gray-700 rounded-lg p-3 bg-green-100 focus:bg-green-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all appearance-none <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="">-- Selecciona un tipo --</option>
            <option value="misterioso" <?php echo e(old('tipo', $evento->tipo) == 'misterioso' ? 'selected' : ''); ?>>Misterioso ❓</option>
            <option value="curar" <?php echo e(old('tipo', $evento->tipo) == 'curar' ? 'selected' : ''); ?>>Curar 💊</option>
            <option value="capturar" <?php echo e(old('tipo', $evento->tipo) == 'capturar' ? 'selected' : ''); ?>>Capturar 🏆</option>
          </select>
          <div class="absolute right-3 top-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </div>
        </div>
        <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <p class="text-red-600 font-medium mt-1 flex items-center">
            <span class="mr-1">!</span>
            <?php echo e($message); ?>

          </p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <!-- Campo de efecto -->
      <div class="mb-6">
        <label for="efecto" class="block font-bold text-lg mb-2 text-gray-800">Efecto:</label>
        <div class="relative">
          <input type="text" name="efecto" id="efecto"
                value="<?php echo e(old('efecto', $evento->efecto)); ?>"
                class="w-full border-2 border-gray-700 rounded-lg p-3 bg-green-100 focus:bg-green-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all <?php $__errorArgs = ['efecto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 bg-red-100 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
          <div class="absolute right-3 top-3">
            <div class="w-3 h-3 rounded-full bg-gray-500"></div>
          </div>
        </div>
        <?php $__errorArgs = ['efecto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <p class="text-red-600 font-medium mt-1 flex items-center">
            <span class="mr-1">!</span>
            <?php echo e($message); ?>

          </p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <!-- Botones de acción -->
      <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 border-t-2 border-gray-300 pt-5">
        <a href="<?php echo e(route('admin.usuarios.index')); ?>"
          class="pokedex-btn bg-gray-700 text-white py-3 px-6 rounded-lg font-bold text-center hover:bg-gray-600 flex items-center justify-center">
          <span class="mr-2">←</span> Cancelar
        </a>
        <button type="submit" 
                class="pokedex-btn bg-blue-600 text-white py-3 px-6 rounded-lg font-bold text-center hover:bg-blue-500 flex items-center justify-center">
          Guardar Cambios <span class="ml-2">→</span>
        </button>
      </div>
    </form>

    <!-- Decoración inferior estilo Pokédex -->
    <div class="bg-red-600 py-3 px-4 flex justify-between items-center border-t-2 border-gray-700">
      <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center">
        <div class="w-8 h-8 rounded-full bg-gray-900"></div>
      </div>
      <div class="grid grid-cols-2 gap-2">
        <div class="w-6 h-6 bg-gray-800 rounded"></div>
        <div class="w-6 h-6 bg-gray-800 rounded"></div>
        <div class="w-6 h-6 bg-gray-800 rounded"></div>
        <div class="w-6 h-6 bg-gray-800 rounded"></div>
      </div>
    </div>
  </div>

  <!-- Estilo complementario específico para esta página -->
  <style>
    input, select, textarea {
      font-family: 'VT323', monospace;
      font-size: 1.1rem;
      letter-spacing: 0.5px;
    }
    
    .pokedex-btn {
      position: relative;
      transition: all 0.2s ease;
      overflow: hidden;
    }
    
    .pokedex-btn:before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
    }
    
    .pokedex-btn:hover:before {
      left: 100%;
    }
    
    /* Animación de los LEDs en el formulario */
    @keyframes blinkForm {
      0% { opacity: 1; }
      50% { opacity: 0.4; }
      100% { opacity: 1; }
    }
    
    .led.red {
      animation: blinkForm 3s infinite ease-in-out;
    }
    
    .led.yellow {
      animation: blinkForm 4s infinite ease-in-out;
      animation-delay: 1s;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/admin/eventos/edit.blade.php ENDPATH**/ ?>