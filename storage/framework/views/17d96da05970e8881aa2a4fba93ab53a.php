<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 py-12">
  <div class="max-w-5xl mx-auto px-6">
    <?php
      // Safe media handling
      $media = null;
      if (method_exists($post, 'getFirstMedia')) {
          try { $media = $post->getFirstMedia('feature_images'); } catch (\Throwable $e) { $media = null; }
      }
      $imageUrl = $media
        ? ($media->getUrl('feature') ?? $media->getUrl())
        : ($post->feature_image ? asset('storage/'.$post->feature_image) : null);

      $webpUrl = $media ? ($media->getUrl('feature_webp') ?? $media->getUrl('feature')) : null;
    ?>

    
    <article class="bg-white rounded-3xl shadow-2xl overflow-hidden">
      
      <!--[if BLOCK]><![endif]--><?php if($imageUrl): ?>
        <div class="relative h-[400px] md:h-[500px] overflow-hidden">
          <picture>
            <!--[if BLOCK]><![endif]--><?php if($webpUrl): ?>
              <source srcset="<?php echo e($webpUrl); ?>" type="image/webp">
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-full object-cover">
          </picture>
          
          
          <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/40 to-transparent"></div>
          
          
          <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12">
            <div class="max-w-4xl">
              <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 leading-tight drop-shadow-lg">
                <?php echo e($post->title); ?>

              </h1>
              
              
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                  <?php echo e(substr(optional($post->author)->name ?? 'U', 0, 1)); ?>

                </div>
                <div class="text-white">
                  <div class="font-bold text-lg"><?php echo e(optional($post->author)->name ?? 'Unknown'); ?></div>
                  <div class="text-sm text-white/80">
                    <!--[if BLOCK]><![endif]--><?php if($post->published_at): ?>
                      <?php echo e($post->published_at->format('M d, Y')); ?> • <?php echo e($post->published_at->diffForHumans()); ?>

                    <?php else: ?>
                      <?php echo e($post->created_at?->diffForHumans() ?? 'Just now'); ?>

                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        
        <div class="relative bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 p-8 md:p-12">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 leading-tight">
            <?php echo e($post->title); ?>

          </h1>
          
          
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white font-bold text-xl shadow-lg">
              <?php echo e(substr(optional($post->author)->name ?? 'U', 0, 1)); ?>

            </div>
            <div class="text-white">
              <div class="font-bold text-lg"><?php echo e(optional($post->author)->name ?? 'Unknown'); ?></div>
              <div class="text-sm text-white/80">
                <!--[if BLOCK]><![endif]--><?php if($post->published_at): ?>
                  <?php echo e($post->published_at->format('M d, Y')); ?> • <?php echo e($post->published_at->diffForHumans()); ?>

                <?php else: ?>
                  <?php echo e($post->created_at?->diffForHumans() ?? 'Just now'); ?>

                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

      
      <div class="p-8 md:p-12">
        
        <!--[if BLOCK]><![endif]--><?php if(!empty($post->excerpt)): ?>
          <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl border-l-4 border-purple-500">
            <p class="text-xl md:text-2xl text-gray-700 font-medium leading-relaxed italic">
              <?php echo e($post->excerpt); ?>

            </p>
          </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        
        <!--[if BLOCK]><![endif]--><?php if($post->tags && $post->tags->count()): ?>
          <div class="mb-8 flex flex-wrap gap-2">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e(route('blogs.index', ['tag' => $tag->slug])); ?>" 
                 class="px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 hover:from-purple-200 hover:to-pink-200 text-purple-700 font-bold text-sm rounded-full transition-all duration-300 hover:scale-105 shadow-sm">
                #<?php echo e($tag->name); ?>

              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
          </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        
        <div class="mb-8 p-6 bg-gray-50 rounded-2xl">
          <div class="flex flex-wrap items-center gap-4 justify-between">
            <div class="flex items-center gap-3">
              <?php
                $reactionButtons = [
                  'like' => ['icon' => '👍', 'label' => 'Like', 'gradient' => 'from-blue-500 to-cyan-500'],
                  'love' => ['icon' => '❤️', 'label' => 'Love', 'gradient' => 'from-pink-500 to-red-500'],
                  'insightful' => ['icon' => '💡', 'label' => 'Insightful', 'gradient' => 'from-yellow-500 to-orange-500'],
                  'celebrate' => ['icon' => '🎉', 'label' => 'Celebrate', 'gradient' => 'from-purple-500 to-pink-500'],
                ];
              ?>

              <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $reactionButtons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $count = $reactions->where('type', $type)->first()?->total ?? 0;
                  $isActive = $userReaction === $type;
                ?>
                <button 
                  wire:click="toggleReaction('<?php echo e($type); ?>')"
                  wire:loading.attr="disabled"
                  class="group relative inline-flex items-center gap-2 px-4 py-2 rounded-full transition-all duration-300 hover:scale-105
                         <?php echo e($isActive 
                            ? 'bg-gradient-to-r ' . $data['gradient'] . ' text-white shadow-lg scale-105' 
                            : 'bg-white hover:bg-gray-100 text-gray-700 shadow-sm'); ?>"
                  title="<?php echo e($data['label']); ?>"
                >
                  <span class="text-lg transition-transform group-hover:scale-125"><?php echo e($data['icon']); ?></span>
                  <!--[if BLOCK]><![endif]--><?php if($count > 0): ?>
                    <span class="text-sm font-bold"><?php echo e($count); ?></span>
                  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </button>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <div class="flex items-center gap-2 text-gray-600">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
              </svg>
              <span class="font-semibold"><?php echo e($commentsCount ?? 0); ?> <?php echo e(Str::plural('Comment', $commentsCount ?? 0)); ?></span>
            </div>
          </div>
        </div>

        
        <div class="prose prose-lg max-w-none mb-12">
          <div class="text-gray-800 leading-relaxed">
            <?php echo $post->body; ?>

          </div>
        </div>

        
        <div class="mt-12 p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
          <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
              <?php echo e(substr(optional($post->author)->name ?? 'U', 0, 1)); ?>

            </div>
            <div>
              <div class="text-sm font-bold text-purple-600 uppercase tracking-wide mb-1">Written by</div>
              <div class="text-2xl font-black text-gray-900"><?php echo e(optional($post->author)->name ?? 'Unknown Author'); ?></div>
            </div>
          </div>
        </div>
      </div>
    </article>

    
    <div class="mt-12 bg-white rounded-3xl shadow-2xl overflow-hidden p-8 md:p-12">
      <div class="mb-8">
        <h2 class="text-3xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
          Comments
        </h2>
        <p class="text-gray-600">Join the conversation and share your thoughts</p>
      </div>
      
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
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/post-show.blade.php ENDPATH**/ ?>