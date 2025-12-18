<div class="space-y-6">
  <div class="flex items-center justify-between">
    <div class="flex items-center gap-3">
      <input type="search" wire:model.debounce.300ms="q" placeholder="Search posts..." class="border rounded px-3 py-2" />
      <!--[if BLOCK]><![endif]--><?php if($q): ?>
        <button wire:click="$set('q', null)" class="text-sm text-gray-500">Clear</button>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <div>
      
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-6">
    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <article class="bg-white rounded shadow p-4 flex flex-col">
        <!--[if BLOCK]><![endif]--><?php if($post->feature_image): ?>
          <img src="<?php echo e(asset('storage/'.$post->feature_image)); ?>" alt="" class="w-full h-44 object-cover rounded mb-3">
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <h3 class="text-lg font-semibold"><a href="<?php echo e(route('blogs.show', $post->slug)); ?>"><?php echo e($post->title); ?></a></h3>
        <p class="text-xs text-gray-500">By <?php echo e($post->author->name); ?> • <?php echo e($post->published_at?->diffForHumans()); ?></p>
        <p class="mt-2 text-gray-700 flex-1"><?php echo e($post->excerpt); ?></p>

        <div class="mt-3 flex items-center justify-between">
          <div class="flex gap-2">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <button wire:click="$set('tag','<?php echo e($tag->slug); ?>')" class="px-2 py-1 bg-gray-100 rounded text-xs"><?php echo e($tag->name); ?></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
          </div>
          <a href="<?php echo e(route('blogs.show', $post->slug)); ?>" class="text-indigo-600 text-sm">Read →</a>
        </div>
      </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="col-span-2 text-center text-gray-500">No posts found.</div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>

  <div>
    <?php echo e($posts->links()); ?>

  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/community/community-feed.blade.php ENDPATH**/ ?>