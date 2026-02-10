<?php
    $gradients = [
        'from-blue-500 via-purple-500 to-pink-500',
        'from-green-400 via-cyan-500 to-blue-500',
        'from-pink-500 via-red-500 to-yellow-500',
        'from-purple-600 via-pink-500 to-red-500',
        'from-indigo-500 via-purple-500 to-pink-500',
        'from-yellow-400 via-orange-500 to-red-500',
    ];
    $randomGradient = $gradients[array_rand($gradients)];
    $commentCount = $post->comments()->count();
?>

<article class="group relative bg-white rounded-3xl border border-gray-100 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden flex flex-col">
    
    <div class="h-2 bg-gradient-to-r <?php echo e($randomGradient); ?>"></div>

    
    <?php if($post->feature_image): ?>
        <div class="relative aspect-[16/9] overflow-hidden">
            <img src="<?php echo e(asset('storage/'.$post->feature_image)); ?>" 
                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110" 
                 alt="<?php echo e($post->title); ?>">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent"></div>
            
            
            <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                <?php $__currentLoopData = $post->tags->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-gray-800 text-xs font-bold rounded-full shadow-lg">
                        <?php echo e($tag->name); ?>

                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="p-6 flex flex-col flex-1">
        
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br <?php echo e($randomGradient); ?> flex items-center justify-center text-white font-bold text-lg shadow-lg">
                <?php echo e(substr($post->author->name, 0, 1)); ?>

            </div>
            <div>
                <div class="text-sm font-bold text-gray-900">
                    <?php echo e($post->author->name); ?>

                </div>
                <div class="text-xs text-gray-500 font-medium">
                    <?php echo e($post->published_at?->diffForHumans() ?? 'Recently'); ?>

                </div>
            </div>
        </div>

        
        <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:bg-gradient-to-r group-hover:<?php echo e($randomGradient); ?> group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300 leading-tight line-clamp-2">
            <a href="<?php echo e(route('blogs.show', $post->slug)); ?>"><?php echo e($post->title); ?></a>
        </h3>

        
        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
            <?php echo e($post->excerpt); ?>

        </p>

        
        <div class="mt-auto pt-4 border-t border-gray-100">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('community.post-interaction', ['post' => $post]);

$__html = app('livewire')->mount($__name, $__params, 'post-reaction-'.$post->id, $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>

        
        <div class="mt-4 pt-4 border-t border-gray-100" x-data="{ showComments: false }">
            
            <button 
                @click="showComments = !showComments"
                class="flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors w-full"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                <span><?php echo e($commentCount); ?> <?php echo e(Str::plural('Comment', $commentCount)); ?></span>
                <svg class="w-4 h-4 ml-auto transform transition-transform" :class="{ 'rotate-180': showComments }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            
            <div x-show="showComments" x-collapse class="mt-4">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('comments.thread', ['post' => $post]);

$__html = app('livewire')->mount($__name, $__params, 'post-comments-'.$post->id, $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>
        </div>

        
        <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="<?php echo e(route('blogs.show', $post->slug)); ?>" 
               class="inline-flex items-center gap-2 text-sm font-bold bg-gradient-to-r <?php echo e($randomGradient); ?> bg-clip-text text-transparent group/btn">
                Read Full Post
                <svg class="w-5 h-5 text-gray-400 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</article>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/partials/post-card-interactive.blade.php ENDPATH**/ ?>