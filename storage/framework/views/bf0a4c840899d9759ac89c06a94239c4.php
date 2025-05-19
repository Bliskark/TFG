

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-4">Editar Equipo</h1>

<form action="<?php echo e(route('equipo.update')); ?>" method="POST" class="space-y-6">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>

  <?php for($i = 1; $i <= 6; $i++): ?>
    <?php
      $currentId = $equipo->{'pokemon'.$i.'_id'} ?? null;
    ?>

    <div class="border p-4 rounded bg-white shadow">
      <h2 class="font-semibold mb-2">Pokémon <?php echo e($i); ?></h2>

      <label>Pokémon:</label>
      <select name="pokemon<?php echo e($i); ?>_name" class="w-full border p-2 mb-2 rounded">
        <option value="">-- Selecciona un Pokémon --</option>
        <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poke): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($poke['name']); ?>"
            <?php if($poke['id'] === $currentId): ?> selected <?php endif; ?>>
            <?php echo e(ucfirst($poke['name'])); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>

      <label>Nivel:</label>
      <input type="number"
             min="1" max="100"
             class="w-full border p-2 mb-2 rounded"
             name="level<?php echo e($i); ?>"
             value="<?php echo e(old('level'.$i, $equipo->{'level'.$i})); ?>">
    </div>
  <?php endfor; ?>

  <button type="submit" class="btn">Actualizar Equipo</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/equipo_edit.blade.php ENDPATH**/ ?>