

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto">
  <h1 class="text-3xl font-bold mb-6 text-center text-red-600">Equipo Pokémon</h1>

  <?php if($equipo && count($datos)): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($p): ?>
        <div class="bg-white border-4 border-red-500 rounded-lg shadow-lg overflow-hidden">
          <div class="bg-red-500 p-2">
            <h2 class="text-xl font-bold text-white text-center"><?php echo e(ucfirst($p['name'])); ?></h2>
          </div>
          <div class="p-4 flex flex-col items-center">
            <img src="<?php echo e($p['sprites']['front_default']); ?>" alt="<?php echo e($p['name']); ?>"
                 class="w-32 h-32 mb-4 bg-gray-100 rounded-full p-2">
            <p class="font-semibold">Nivel: <span class="text-blue-600"><?php echo e($equipo->{'level'.($index+1)}); ?></span></p>
            <ul class="mt-3 w-full">
              <?php $__currentLoopData = $p['stats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex justify-between text-sm py-1 border-b border-gray-200">
                  <span class="capitalize"><?php echo e($stat['stat']['name']); ?></span>
                  <span class="font-mono"><?php echo e($stat['base_stat']); ?></span>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-8 text-center">
      <a href="<?php echo e(route('equipo.edit')); ?>"
         class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded-full shadow">
        Editar Equipo
      </a>
    </div>
  <?php else: ?>
    <div class="text-center py-10">
      <p class="mb-4 text-gray-700">No tienes un equipo creado aún.</p>
      <a href="<?php echo e(route('equipo.create')); ?>"
         class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded-full shadow">
        Crear Equipo
      </a>
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/equipo.blade.php ENDPATH**/ ?>