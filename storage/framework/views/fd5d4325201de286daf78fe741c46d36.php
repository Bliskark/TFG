

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-4">Resultado del Combate</h1>

<?php if(session('evento')): ?>
  <div class="p-4 bg-gray-100 rounded">
    <h2 class="font-semibold">Evento: <?php echo e(session('evento')->name); ?></h2>
    <p><?php echo e(session('evento')->description); ?></p>
  </div>
<?php endif; ?>

<a href="<?php echo e(route('equipo.index')); ?>" class="mt-6 inline-block btn">Ver Mi Equipo</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/battle_result.blade.php ENDPATH**/ ?>