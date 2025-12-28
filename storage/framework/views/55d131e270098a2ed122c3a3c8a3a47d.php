

<?php $__env->startSection('dashboard-content'); ?>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                <a href="<?php echo e(route('trainer.courses.index')); ?>" class="hover:text-slate-700">Courses</a>
                <span>/</span>
                <span><?php echo e($course->code ?? 'Overview'); ?></span>
            </div>
            <h1 class="text-2xl font-bold text-slate-800"><?php echo e($course->title); ?></h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('trainer.courses.edit', $course->slug)); ?>" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-md hover:bg-slate-50 transition-colors">
                Edit Details
            </a>
            <a href="<?php echo e(route('trainer.chapters.index', $course->slug)); ?>" class="px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors">
                Manage Content
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">About Course</h3>
                
                <?php if($course->description): ?>
                    <div class="mb-4">
                        <p class="text-slate-600 italic"><?php echo e($course->description); ?></p>
                    </div>
                <?php endif; ?>

                <?php if($course->body): ?>
                    <div class="prose prose-sm max-w-none text-slate-600">
                        <?php echo \Parsedown::instance()->text($course->body); ?>

                    </div>
                <?php elseif(!$course->description): ?>
                    <p class="italic text-slate-400">No description provided.</p>
                <?php endif; ?>

                <?php if($course->tags && count($course->tags) > 0): ?>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <p class="text-xs font-medium text-slate-500 mb-2">TAGS</p>
                        <div class="flex flex-wrap gap-2">
                            <?php $__currentLoopData = $course->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 rounded text-xs"><?php echo e($tag); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($course->zoom_url || $course->youtube_url): ?>
                    <div class="mt-4 pt-4 border-t border-slate-100 flex gap-4">
                        <?php if($course->zoom_url): ?>
                            <a href="<?php echo e($course->zoom_url); ?>" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100 transition-colors text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 13.464a.992.992 0 01-.993.992H7.1a.992.992 0 01-.993-.992V10.54c0-.55.445-.993.993-.993h9.801c.548 0 .993.443.993.993v2.924z"/></svg>
                                Join Zoom Meeting
                            </a>
                        <?php endif; ?>
                        <?php if($course->youtube_url): ?>
                            <a href="<?php echo e($course->youtube_url); ?>" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 bg-red-50 text-red-700 rounded-md hover:bg-red-100 transition-colors text-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                Watch Preview
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                    <h3 class="font-semibold text-slate-900">Chapters</h3>
                    <span class="text-xs font-medium bg-slate-200 text-slate-600 px-2 py-1 rounded-full"><?php echo e($chapters->count()); ?> Total</span>
                </div>
                <?php if($chapters->isEmpty()): ?>
                    <div class="p-8 text-center">
                        <p class="text-slate-500 mb-4">No chapters added yet.</p>
                        <a href="<?php echo e(route('trainer.chapters.index', $course->slug)); ?>" class="text-sky-600 hover:underline font-medium">Add your first chapter</a>
                    </div>
                <?php else: ?>
                    <ul class="divide-y divide-slate-100">
                        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="px-6 py-3 flex items-center justify-between hover:bg-slate-50">
                                <div class="flex items-center gap-3">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-medium">
                                        <?php echo e($chapter->order); ?>

                                    </span>
                                    <span class="text-slate-700 font-medium"><?php echo e($chapter->title); ?></span>
                                </div>
                                <span class="text-xs text-slate-400">
                                    
                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php if($chapters->hasPages()): ?>
                        <div class="px-6 py-4 border-t border-slate-100">
                            <?php echo e($chapters->links()); ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-semibold text-sm uppercase text-slate-500 tracking-wider mb-4">Quick Stats</h3>
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-slate-600">Status</dt>
                        <dd>
                             <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?php echo e($course->is_public ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700'); ?>">
                                <?php echo e($course->is_public ? 'Published' : 'Draft'); ?>

                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-600">Students</dt>
                        <dd class="font-medium text-slate-900"><?php echo e($course->students->count()); ?></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-600">Created</dt>
                        <dd class="font-medium text-slate-900"><?php echo e($course->created_at->format('M d, Y')); ?></dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(request()->ajax() ? 'layouts.plain' : 'dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/trainer/courses/show.blade.php ENDPATH**/ ?>