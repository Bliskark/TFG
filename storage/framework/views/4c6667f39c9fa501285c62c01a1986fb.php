

<?php $__env->startSection('title', 'Estadísticas'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-6">📊 Estadísticas Generales</h1>

<h2 class="text-xl font-semibold mt-6 mb-2">🔥 Top 10 Pokémon más usados</h2>
<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
  <?php $__currentLoopData = $topPokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="bg-white rounded shadow p-3 flex flex-col items-center text-center">
    <img src="<?php echo e($p->image); ?>" alt="<?php echo e($p->name); ?>" class="w-20 h-20 mb-2">
    <div class="font-semibold text-lg"><?php echo e($p->name); ?></div>
    <div class="text-sm text-gray-600">Usado <?php echo e($p->cnt); ?> veces</div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<h2 class="text-xl font-semibold mt-10 mb-2">🏆 Top 5 Entrenadores</h2>
<table class="min-w-full bg-white border rounded shadow">
  <thead class="bg-gray-100">
    <tr>
      <th class="py-2 px-4 text-left">Email</th>
      <th class="py-2 px-4 text-left">Victorias</th>
    </tr>
  </thead>
  <tbody>
    <?php $__currentLoopData = $topUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="border-t hover:bg-gray-50">
      <td class="py-2 px-4"><?php echo e($u->email); ?></td>
      <td class="py-2 px-4 font-bold"><?php echo e($u->victories); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/statistics.blade.php ENDPATH**/ ?>