<div class="flex items-center gap-2 flex-wrap">
    <?php
        $reactions = [
            'like' => ['icon' => '👍', 'color' => 'from-blue-500 to-blue-600', 'label' => 'Like'],
            'love' => ['icon' => '❤️', 'color' => 'from-pink-500 to-red-500', 'label' => 'Love'],
            'celebrate' => ['icon' => '🎉', 'color' => 'from-yellow-500 to-orange-500', 'label' => 'Celebrate'],
            'insightful' => ['icon' => '💡', 'color' => 'from-purple-500 to-indigo-500', 'label' => 'Insightful'],
            'curious' => ['icon' => '🤔', 'color' => 'from-green-500 to-teal-500', 'label' => 'Curious'],
        ];
    ?>

    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $reactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button 
            wire:click="toggleReaction('<?php echo e($type); ?>')"
            class="group relative inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full transition-all duration-300 
                   <?php echo e($userReaction === $type 
                      ? 'bg-gradient-to-r ' . $data['color'] . ' text-white shadow-lg scale-105' 
                      : 'bg-gray-100 hover:bg-gray-200 text-gray-600 hover:scale-105'); ?>"
            title="<?php echo e($data['label']); ?>"
        >
            <span class="text-base transition-transform group-hover:scale-125"><?php echo e($data['icon']); ?></span>
            <!--[if BLOCK]><![endif]--><?php if(isset($reactionCounts[$type]) && $reactionCounts[$type] > 0): ?>
                <span class="text-xs font-bold"><?php echo e($reactionCounts[$type]); ?></span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            
            
            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">
                <?php echo e($data['label']); ?>

            </span>
        </button>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php
        $totalReactions = array_sum($reactionCounts);
    ?>
    
    <!--[if BLOCK]><![endif]--><?php if($totalReactions > 0): ?>
        <span class="text-xs text-gray-500 font-medium ml-1">
            <?php echo e($totalReactions); ?> <?php echo e(Str::plural('reaction', $totalReactions)); ?>

        </span>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/community/post-interaction.blade.php ENDPATH**/ ?>