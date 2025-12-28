

<?php $__env->startSection('title', $post->title); ?>


<?php $__env->startSection('meta'); ?>
  <meta name="description" content="<?php echo e(e($post->excerpt ?: Str::limit(strip_tags($post->body), 160))); ?>">
  <meta property="og:title" content="<?php echo e(e($post->title)); ?>">
  <meta property="og:description" content="<?php echo e(e($post->excerpt ?: Str::limit(strip_tags($post->body), 160))); ?>">
  <?php
    $ogImage = null;
    if (method_exists($post, 'getFirstMedia')) {
        try {
            $m = $post->getFirstMedia('feature_images');
            $ogImage = $m ? ($m->getUrl('thumb') ?? $m->getUrl()) : null;
        } catch (\Throwable $e) { $ogImage = null; }
    } else {
        $ogImage = $post->feature_image ? asset('storage/'.$post->feature_image) : null;
    }
  ?>
  <?php if($ogImage): ?>
    <meta property="og:image" content="<?php echo e($ogImage); ?>">
    <meta name="twitter:card" content="summary_large_image">
  <?php endif; ?>

  <link rel="canonical" href="<?php echo e(url()->current()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('post-show', ['slug' => $post->slug]);

$__html = app('livewire')->mount($__name, $__params, 'lw-4258259864-0', $__slots ?? [], get_defined_vars());

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/blogs/show.blade.php ENDPATH**/ ?>