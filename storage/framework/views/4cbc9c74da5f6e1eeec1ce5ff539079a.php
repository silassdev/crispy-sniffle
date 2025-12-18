<?php
    $posts = $posts ?? \App\Models\Post::latest()->take(8)->get();
?>

<div class="space-y-4">
  <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <article class="p-4 border rounded hover:shadow-sm transition" data-reveal>
      <a href="<?php echo e(url('/blogs/' . ($post->slug ?? $post->id))); ?>" class="block">
        <h3 class="font-semibold text-lg"><?php echo e($post->title ?? 'Untitled post'); ?></h3>
        <p class="text-sm text-gray-500 mt-1"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->body ?? ''), 140)); ?></p>
      </a>
      <div class="mt-3 text-xs text-gray-400">
        <span><?php echo e($post->created_at?->diffForHumans() ?? ''); ?></span>
      </div>
    </article>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="p-6 border rounded text-center">
      <p class="text-gray-600 mb-3">No posts yet.</p>
      <a href="<?php echo e(route('blogs') ?? '#'); ?>" class="text-sm text-indigo-600">Browse posts</a>
    </div>
  <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/partials/feed.blade.php ENDPATH**/ ?>