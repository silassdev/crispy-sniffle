

<?php $__env->startSection('title', 'Blogs'); ?>

<?php $__env->startSection('content'); ?>
  <div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Blog</h1>
      <form method="GET" action="<?php echo e(route('blogs.index')); ?>" class="flex items-center gap-2">
        <input name="q" value="<?php echo e(request('q')); ?>" placeholder="Search posts..." class="border rounded px-3 py-2 text-sm" />
        <button class="px-3 py-2 bg-indigo-600 text-white rounded text-sm">Search</button>
      </form>
    </div>

    <div>
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('community.community-feed', ['postType' => 'blog']);

$__html = app('livewire')->mount($__name, $__params, 'lw-3935999579-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/blogs/index.blade.php ENDPATH**/ ?>