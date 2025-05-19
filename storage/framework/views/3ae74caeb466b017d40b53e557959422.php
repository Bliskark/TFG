

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto">
  <h1 class="text-3xl font-bold mb-6 text-center text-red-600">Pokédex</h1>

  <?php if(count($pokemons)): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          // extraer id de la URL
          $segments = explode('/', trim($p['url'], '/'));
          $pid = intval(end($segments));
        ?>

        <a href="<?php echo e(route('pokedex.show', ['id' => $pid])); ?>"
           class="block bg-gray-100 border-4 border-red-500 rounded-lg overflow-hidden shadow hover:shadow-xl transition">
          <div class="bg-red-500 p-2">
            <h2 class="text-lg font-bold text-white text-center"><?php echo e(ucfirst($p['name'])); ?></h2>
          </div>
          <div class="p-4 flex justify-center">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/<?php echo e($pid); ?>.png"
                 alt="<?php echo e($p['name']); ?>"
                 class="w-20 h-20">
          </div>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="flex justify-between items-center mt-8">
      <?php if($page > 1): ?>
        <a href="?page=<?php echo e($page - 1); ?>"
           class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">Anterior</a>
      <?php else: ?>
        <span></span>
      <?php endif; ?>

      <?php if($hasMore): ?>
        <a href="?page=<?php echo e($page + 1); ?>"
           class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">Siguiente</a>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <p class="text-center text-gray-700">No se encontraron Pokémon. Intenta recargar la página.</p>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/pokedex.blade.php ENDPATH**/ ?>