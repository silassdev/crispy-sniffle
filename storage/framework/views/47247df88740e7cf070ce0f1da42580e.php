

<?php $__env->startSection('title', 'Our Blog'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-slate-900 py-24 mb-16 group">
        <!-- Abstract Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600 rounded-full blur-[100px] opacity-40 group-hover:opacity-60 transition-opacity"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 animate-fade-in-up text-white font-['Playfair_Display']">
                    Insights & <span class="text-indigo-400">Stories</span>
                </h1>
                <p class="text-xl text-indigo-100/60 mb-10 leading-relaxed">
                    Explore our latest articles, tutorials, and community updates. Stay ahead of the curve with expert knowledge.
                </p>

                <!-- Integrated Search -->
                <form method="GET" action="<?php echo e(route('blogs.index')); ?>" class="relative max-w-xl mx-auto group/search">
                    <input name="q" value="<?php echo e(request('q')); ?>" placeholder="Search our articles..." 
                           class="w-full px-8 py-5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-indigo-200 outline-none focus:ring-4 focus:ring-indigo-500/20 focus:bg-white/20 transition-all duration-300 shadow-2xl" />
                    <button class="absolute right-3 top-2.5 px-6 py-2.5 bg-indigo-500 hover:bg-indigo-400 text-white font-bold rounded-xl transition duration-300 shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="hidden sm:inline">Search</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Feed Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <?php if(request('q')): ?>
            <div class="mb-12 flex items-center gap-4 animate-fade-in-up">
                <p class="text-gray-500 font-medium">Showing results for:</p>
                <span class="px-4 py-1.5 bg-blue-100 text-blue-700 rounded-full font-bold text-sm border border-blue-200 shadow-sm">
                    "<?php echo e(request('q')); ?>"
                </span>
                <a href="<?php echo e(route('blogs.index')); ?>" class="text-sm text-gray-400 hover:text-blue-600 transition-colors font-bold underline underline-offset-4">Clear search</a>
            </div>
        <?php endif; ?>

        <div class="bg-white/50 rounded-[3rem] p-8 md:p-12 border border-gray-100 shadow-sm backdrop-blur-sm">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('community.community-feed', ['postType' => 'blog']);

$__html = app('livewire')->mount($__name, $__params, 'lw-3935999579-0', $__slots ?? [], get_defined_vars());

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

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/blogs/index.blade.php ENDPATH**/ ?>