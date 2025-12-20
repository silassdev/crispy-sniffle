

<?php $__env->startSection('title'); ?>
Home — <?php echo e(config('app.name')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
    
    <section class="relative overflow-hidden bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 py-16">
        
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-96 h-96 bg-red-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-black text-white mb-4 drop-shadow-lg">
                    What's up, <?php echo e(explode(' ', $user->name)[0]); ?>? 👋
                </h1>
                <p class="text-xl md:text-2xl text-white/90 font-medium max-w-2xl mx-auto">
                    Welcome back to your learning community
                </p>
            </div>
        </div>
    </section>

    
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-12">
            <div class="inline-block relative">
                <h2 class="text-4xl md:text-5xl font-black bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
                    Explore The Community
                </h2>
                <div class="h-1.5 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-full"></div>
            </div>
            <p class="text-gray-600 text-lg mt-4">
                Connect, learn, and grow with our vibrant community
            </p>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <?php
                $stats = [
                    [
                        'label' => 'Active Posts',
                        'value' => $posts->count(),
                        'icon' => '📝',
                        'gradient' => 'from-blue-500 to-cyan-500',
                        'bg' => 'bg-blue-50'
                    ],
                    [
                        'label' => 'Community Members',
                        'value' => \App\Models\User::count(),
                        'icon' => '👥',
                        'gradient' => 'from-purple-500 to-pink-500',
                        'bg' => 'bg-purple-50'
                    ],
                    [
                        'label' => 'Total Interactions',
                        'value' => \App\Models\Reaction::count() + \App\Models\Comment::count(),
                        'icon' => '⚡',
                        'gradient' => 'from-orange-500 to-red-500',
                        'bg' => 'bg-orange-50'
                    ]
                ];
            ?>

            <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r <?php echo e($stat['gradient']); ?> rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative <?php echo e($stat['bg']); ?> rounded-2xl p-6 border border-white shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-1"><?php echo e($stat['label']); ?></p>
                                <p class="text-4xl font-black bg-gradient-to-r <?php echo e($stat['gradient']); ?> bg-clip-text text-transparent">
                                    <?php echo e($stat['value']); ?>

                                </p>
                            </div>
                            <div class="text-5xl"><?php echo e($stat['icon']); ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-1 flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                <h3 class="text-2xl font-bold text-gray-900">Latest Community Posts</h3>
                <div class="h-1 flex-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
            </div>

            <?php if($posts->isNotEmpty()): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div data-reveal>
                            <?php echo $__env->make('partials.post-card-interactive', ['post' => $post], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-purple-100 to-pink-100 mb-6">
                        <svg class="w-12 h-12 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No posts yet</h3>
                    <p class="text-gray-600 mb-6">Be the first to share something with the community!</p>
                    <a href="<?php echo e(route('blogs.index')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-full hover:shadow-lg transition-all">
                        Explore Archive
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        
        <?php if($posts->isNotEmpty()): ?>
            <div class="text-center mt-12">
                <a href="<?php echo e(route('blogs.index')); ?>" 
                   class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white font-bold text-lg rounded-full shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <span>Explore All Posts</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        <?php endif; ?>
    </section>
</div>


<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/home/auth/user.blade.php ENDPATH**/ ?>