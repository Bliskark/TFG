

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
  <h1 class="text-2xl font-bold mb-6">Login</h1>
  <form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    <div class="mb-4">
      <label class="block mb-1" for="email">Email</label>
      <input id="email" type="email" name="email" required autofocus class="w-full border rounded p-2">
    </div>
    <div class="mb-4">
      <label class="block mb-1" for="password">Password</label>
      <input id="password" type="password" name="password" required class="w-full border rounded p-2">
    </div>
    <div class="flex items-center justify-between">
      <button type="submit" class="btn">Login</button>
      <?php if(Route::has('password.request')): ?>
        <a href="<?php echo e(route('password.request')); ?>" class="text-blue-500 underline">Forgot Password?</a>
      <?php endif; ?>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/login.blade.php ENDPATH**/ ?>