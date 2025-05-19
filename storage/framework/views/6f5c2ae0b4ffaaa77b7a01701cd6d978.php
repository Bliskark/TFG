

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-4">Batalla</h1>

<form action="<?php echo e(route('battle.fight')); ?>" method="POST">
  <?php echo csrf_field(); ?>
  <button type="submit" class="btn">Luchar</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/battle_show.blade.php ENDPATH**/ ?>