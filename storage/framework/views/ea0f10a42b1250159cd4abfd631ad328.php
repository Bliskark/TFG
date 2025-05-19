

<?php $__env->startSection('content'); ?>
<h1>Crear Equipo</h1>

<form action="<?php echo e(route('equipo.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php for($i = 1; $i <= 6; $i++): ?>
        <div>
            <label for="pokemon<?php echo e($i); ?>">Pokémon <?php echo e($i); ?>:</label>
            <select name="pokemon<?php echo e($i); ?>_name" id="pokemon<?php echo e($i); ?>">
                <option value="">-- Selecciona un Pokémon --</option>
                <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poke): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($poke['name']); ?>"><?php echo e(ucfirst($poke['name'])); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label for="level<?php echo e($i); ?>">Nivel:</label>
            <input type="number" name="level<?php echo e($i); ?>" id="level<?php echo e($i); ?>" min="1" max="100" value="1">
        </div>
    <?php endfor; ?>
    <button type="submit">Guardar Equipo</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/equipo_create.blade.php ENDPATH**/ ?>