

<?php $__env->startSection('title', 'Crear Evento'); ?>

<?php $__env->startSection('content'); ?>
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
      <h1 class="text-2xl font-bold ml-auto text-white tracking-wider">REGISTRAR EVENTO</h1>
    </div>

    <!-- Pantalla principal -->
    <div class="bg-gray-100 rounded-lg p-5 border-2 border-gray-800">
      <!-- Errores de validación -->
      <?php if(session('errors') instanceof \Illuminate\Support\ViewErrorBag && session('errors')->any()): ?>
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded border border-red-400">
          <div class="flex items-center mb-1">
            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="font-bold">ERRORES DETECTADOS:</span>
          </div>
          <ul class="list-disc list-inside">
            <?php $__currentLoopData = session('errors')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($msg); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('admin.eventos.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
          <label for="name" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">NOMBRE</label>
          <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>"
                class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300" 
                required>
        </div>

        <div class="mb-4">
          <label for="description" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">DESCRIPCIÓN</label>
          <textarea name="description" id="description" rows="3"
                  class="w-full border-2 border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300"><?php echo e(old('description')); ?></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
          <div class="bg-yellow-100 p-3 rounded-lg border-2 border-yellow-400">
            <label for="tipo" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">TIPO</label>
            <select name="tipo" id="tipo" required
                  class="w-full border-2 border-gray-400 bg-white rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300">
              <option value="">-- Selecciona --</option>
              <option value="misterioso"  <?php echo e(old('tipo')=='misterioso' ? 'selected' : ''); ?>>Misterioso</option>
              <option value="curar"       <?php echo e(old('tipo')=='curar'      ? 'selected' : ''); ?>>Curar</option>
              <option value="capturar"    <?php echo e(old('tipo')=='capturar'   ? 'selected' : ''); ?>>Capturar</option>
            </select>
          </div>
          <div class="bg-blue-100 p-3 rounded-lg border-2 border-blue-400">
            <label for="efecto" class="block text-gray-800 font-semibold mb-1 uppercase text-sm tracking-wider">EFECTO</label>
            <input type="text" name="efecto" id="efecto" value="<?php echo e(old('efecto')); ?>"
                class="w-full border-2 border-gray-400 bg-white rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300"
                placeholder="+1 nivel, -10 HP, etc." required>
          </div>
        </div>

        <!-- Líneas decorativas estilo Pokédex -->
        <div class="flex items-center my-4">
          <div class="h-2 flex-grow bg-gray-300 rounded"></div>
          <div class="mx-2 w-8 h-8 rounded-full border-2 border-gray-800 bg-gray-300 flex items-center justify-center">
            <div class="w-4 h-4 rounded-full bg-gray-600"></div>
          </div>
          <div class="h-2 flex-grow bg-gray-300 rounded"></div>
        </div>

        <div class="flex justify-between items-center">
          <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="text-blue-700 hover:underline flex items-center">
            <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Regresar
          </a>
          <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-md transform hover:scale-105 transition-transform duration-200 border-2 border-gray-800">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/admin/eventos/create.blade.php ENDPATH**/ ?>