

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto p-4 bg-white shadow rounded">
  <img src="<?php echo e($pokemon['sprites']['front_default']); ?>" alt="<?php echo e($pokemon['name']); ?>" class="mx-auto mb-4">
  <h2 class="text-2xl font-bold mb-2"><?php echo e(ucfirst($pokemon['name'])); ?></h2>
  <p class="mb-4"><?php echo e($description); ?></p>
  <h3 class="font-semibold">Stats:</h3>
  <ul class="list-disc list-inside">
    <?php $__currentLoopData = $pokemon['stats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e(ucfirst($stat['stat']['name'])); ?>: <?php echo e($stat['base_stat']); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/pokedex_show.blade.php ENDPATH**/ ?>