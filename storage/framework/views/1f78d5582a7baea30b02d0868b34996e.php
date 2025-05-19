

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
  <h1 class="text-2xl font-bold mb-6">Register</h1>
  <form method="POST" action="<?php echo e(route('register')); ?>">
    <?php echo csrf_field(); ?>
    <div class="mb-4">
      <label class="block mb-1" for="name">Name</label>
      <input id="name" type="text" name="name" required class="w-full border rounded p-2">
    </div>
    <div class="mb-4">
      <label class="block mb-1" for="email">Email</label>
      <input id="email" type="email" name="email" required class="w-full border rounded p-2">
    </div>
    <div class="mb-4">
      <label class="block mb-1" for="password">Password</label>
      <input id="password" type="password" name="password" required class="w-full border rounded p-2">
    </div>
    <div class="mb-4">
      <label class="block mb-1" for="password_confirmation">Confirm Password</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border rounded p-2">
    </div>
    <button type="submit" class="btn">Register</button>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Blisk\Desktop\pokeCombates\resources\views/register.blade.php ENDPATH**/ ?>