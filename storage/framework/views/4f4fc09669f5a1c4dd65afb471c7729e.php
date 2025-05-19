

<?php $__env->startSection('title', 'Resultado de la Batalla'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow text-center space-y-4">
  <?php if(session('result') === 'win'): ?>
    <h1 class="text-3xl font-bold text-green-600">¡Victoria!</h1>
    <p>Has ganado y tu Pokémon sube de nivel.</p>
  <?php else: ?>
    <h1 class="text-3xl font-bold text-red-600">¡Derrota!</h1>
    <p>Tu Pokémon ha caído. ¡Inténtalo de nuevo!</p>
  <?php endif; ?>

  <div class="mt-6 flex justify-center space-x-4">
    <a href="<?php echo e(route('battle.show')); ?>" class="pokedex-btn bg-blue-500">Seguir Luchando</a>
    <a href="<?php echo e(route('home')); ?>" class="pokedex-btn bg-gray-500">Volver al Menú</a>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/battle/result.blade.php ENDPATH**/ ?>