
<?php $__env->startSection('content'); ?>
  <article class="prose lg:prose-xl mx-auto">
    <h1><?php echo e($post->title); ?></h1>
    <p class="text-sm text-gray-500">By <?php echo e($post->author->name); ?> • <?php echo e($post->published_at->toDayDateTimeString()); ?></p>
    <?php if($post->feature_image): ?>
      <img src="<?php echo e(asset('storage/'.$post->feature_image)); ?>" alt="" class="w-full rounded my-4">
    <?php endif; ?>
    <div class="mt-4"><?php echo $post->body; ?></div>
  </article>

  <div class="mt-10">
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('comments.thread', ['post' => $post]);

$__html = app('livewire')->mount($__name, $__params, 'lw-4258259864-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/blogs/show.blade.php ENDPATH**/ ?>