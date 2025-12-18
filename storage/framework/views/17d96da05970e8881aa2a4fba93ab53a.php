<div class="prose lg:prose-xl mx-auto">
  <?php
    // safe media handling: support Spatie medialibrary if available,
    // otherwise fall back to legacy feature_image path.
    $media = null;
    if (method_exists($post, 'getFirstMedia')) {
        try { $media = $post->getFirstMedia('feature_images'); } catch (\Throwable $e) { $media = null; }
    }
    $imageUrl = $media
      ? ($media->getUrl('feature') ?? $media->getUrl())
      : ($post->feature_image ? asset('storage/'.$post->feature_image) : null);

    $webpUrl = $media ? ($media->getUrl('feature_webp') ?? $media->getUrl('feature')) : null;
  ?>

  
  <!--[if BLOCK]><![endif]--><?php if($imageUrl): ?>
    <figure class="m-0">
      <picture>
        <!--[if BLOCK]><![endif]--><?php if($webpUrl): ?>
          <source srcset="<?php echo e($webpUrl); ?>" type="image/webp">
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-64 object-cover rounded">
      </picture>
    </figure>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

  
  <h1 class="mt-4 font-bold"><?php echo e($post->title); ?></h1>

  
  <div class="text-sm text-gray-500 mb-4">
    By <?php echo e(optional($post->author)->name ?? 'Unknown'); ?> •
    <!--[if BLOCK]><![endif]--><?php if($post->published_at): ?>
      <?php echo e($post->published_at->toDayDateTimeString()); ?>

    <?php else: ?>
      <?php echo e($post->created_at?->diffForHumans() ?? 'Just now'); ?>

    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>

  
  <!--[if BLOCK]><![endif]--><?php if(!empty($post->excerpt)): ?>
    <p class="text-lg text-gray-700"><?php echo e($post->excerpt); ?></p>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

  
  <div class="flex items-center gap-4 mt-4">
    <div class="flex items-center gap-2">
      <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $reactions ?? collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="text-sm text-gray-600"><?php echo e($r->type); ?> • <?php echo e($r->total); ?></div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div class="flex items-center gap-2 ml-auto">
      <button wire:click="toggleReaction('like')" class="px-3 py-1 border rounded text-sm" wire:loading.attr="disabled">
        👍 Like
      </button>
      <button wire:click="toggleReaction('love')" class="px-3 py-1 border rounded text-sm" wire:loading.attr="disabled">
        💚 Love
      </button>
      <div class="text-sm text-gray-500 ml-3"><?php echo e($commentsCount ?? $post->comments()->count()); ?> comments</div>
    </div>
  </div>

  
  <article class="mt-6 leading-relaxed text-gray-800">
    <?php echo $post->body; ?>

  </article>

  
  <!--[if BLOCK]><![endif]--><?php if($post->tags && $post->tags->count()): ?>
    <div class="mt-6 flex flex-wrap gap-2">
      <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('blogs.index', ['tag' => $tag->slug])); ?>" class="text-xs bg-gray-100 px-2 py-1 rounded"><?php echo e($tag->name); ?></a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

  
  <div class="mt-10">
    <h3 class="text-lg font-semibold mb-3">Comments</h3>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('comments.thread', ['post' => $post]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3167954286-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/post-show.blade.php ENDPATH**/ ?>