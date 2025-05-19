

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-4">Equipo de <?php echo e($usuario->email); ?></h1>

<?php if(session('success')): ?>
  <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
    <?php echo e(session('success')); ?>

  </div>
<?php endif; ?>

<?php if($equipo): ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    <?php for($i = 1; $i <= 6; $i++): ?>
      <?php
        $pokeId = $equipo?->{"pokemon{$i}_id"};
        $level  = $equipo?->{"level{$i}"};
        $hp     = $equipo?->{"hp{$i}"};
        $poke = null;
        if ($pokeId) {
            try {
                $poke = \Illuminate\Support\Facades\Http::get("https://pokeapi.co/api/v2/pokemon/{$pokeId}")->json();
            } catch (\Exception $e) {}
        }
      ?>

      <?php if($poke): ?>
      <div class="bg-white border rounded shadow p-4 text-center">
        <img src="<?php echo e($poke['sprites']['front_default']); ?>" class="mx-auto mb-2">
        <h3 class="font-bold text-lg"><?php echo e(ucfirst($poke['name'])); ?></h3>
        <p><strong>Nivel:</strong> <?php echo e($level); ?></p>
        <p><strong>HP:</strong> <?php echo e($hp); ?></p>
      </div>
      <?php endif; ?>
    <?php endfor; ?>
  </div>
<?php else: ?>
  <p>No tiene equipo.</p>
<?php endif; ?>

<hr class="my-6">

<h2 class="text-xl font-bold mb-4">Editar Equipo</h2>

<form action="<?php echo e(route('admin.usuarios.equipo.update', $usuario->id)); ?>" method="POST" class="space-y-6">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>

  <?php for($i = 1; $i <= 6; $i++): ?>
    <?php
      $currentId = $equipo?->{"pokemon{$i}_id"};
      $currentLevel = $equipo?->{"level{$i}"} ?? '';
    ?>

    <div class="border p-4 rounded bg-gray-100">
      <h3 class="font-semibold mb-2">Pokémon <?php echo e($i); ?></h3>

      <label class="block mb-1">Pokémon:</label>
      <select name="pokemon<?php echo e($i); ?>_name" class="w-full border p-2 mb-2 rounded">
        <option value="">-- Selecciona un Pokémon --</option>
        <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poke): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($poke['name']); ?>"
            <?php if($poke['id'] === $currentId): ?> selected <?php endif; ?>>
            <?php echo e(ucfirst($poke['name'])); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>

      <label class="block mb-1">Nivel:</label>
      <input type="number"
             min="1" max="100"
             name="level<?php echo e($i); ?>"
             class="w-full border p-2 rounded"
             value="<?php echo e(old("level{$i}", $currentLevel)); ?>">
    </div>
  <?php endfor; ?>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4">
    Guardar Cambios
  </button>
  <a href="<?php echo e(route('admin.usuarios.index')); ?>" class="ml-4 text-gray-600 hover:underline">
    ← Volver a usuarios
  </a>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/admin/usuarios/equipo.blade.php ENDPATH**/ ?>