<article class="group relative bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col h-full">
  <!-- Image Container -->
  <?php if($post->feature_image): ?>
    <div class="relative aspect-[16/10] overflow-hidden">
        <img src="<?php echo e(asset('storage/'.$post->feature_image)); ?>" 
             class="w-full h-full object-cover transition duration-700 group-hover:scale-110" 
             alt="<?php echo e($post->title); ?>">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        
        <!-- Tags on Image -->
        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
            <?php $__currentLoopData = $post->tags->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-wider rounded-full border border-white/30">
                    <?php echo e($tag->name); ?>

                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
  <?php endif; ?>

  <!-- Content -->
  <div class="p-8 flex flex-col flex-1">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-blue-200">
            <?php echo e(substr($post->author->name, 0, 1)); ?>

        </div>
        <div>
            <div class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em]">
                <?php echo e($post->author->name); ?>

            </div>
            <div class="text-[10px] text-gray-400 font-medium">
                <?php echo e($post->published_at?->format('M d, Y') ?? 'Recently'); ?>

            </div>
        </div>
    </div>

    <h3 class="text-2xl font-extrabold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300 leading-tight line-clamp-2">
        <a href="<?php echo e(route('blogs.show', $post->slug)); ?>"><?php echo e($post->title); ?></a>
    </h3>

    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-8">
        <?php echo e($post->excerpt); ?>

    </p>

    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
        <div class="flex gap-3">
             <?php $__currentLoopData = $post->tags->slice(2, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('blogs.index', ['tag' => $tag->slug])); ?>" 
                   class="text-[10px] font-bold text-gray-400 hover:text-blue-600 transition-colors uppercase tracking-widest">
                    #<?php echo e($tag->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <a href="<?php echo e(route('blogs.show', $post->slug)); ?>" 
           class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 group/btn">
            Explore
            <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>
  </div>
</article>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/partials/post-card.blade.php ENDPATH**/ ?>