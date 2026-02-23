

<?php $__env->startSection('dashboard-content'); ?>
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center gap-2 text-sm text-slate-500">
            <a href="<?php echo e(route('trainer.courses.index')); ?>" class="hover:text-slate-700">Courses</a>
            <span>/</span>
            <a href="<?php echo e(route('trainer.courses.show', $course->slug)); ?>" class="hover:text-slate-700"><?php echo e($course->title); ?></a>
            <span>/</span>
            <span>Edit</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h1 class="text-xl font-bold text-slate-800 mb-6">Edit Course</h1>
            
            <form action="<?php echo e(route('trainer.courses.update', $course->slug)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Course Title</label>
                    <input type="text" name="title" id="title" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="<?php echo e(old('title', $course->title)); ?>" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium text-slate-700 mb-2">Slug</label>
                    <input type="text" name="slug" id="slug" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="<?php echo e(old('slug', $course->slug)); ?>">
                    <p class="mt-1 text-xs text-slate-500">Unique URL identifier for the course.</p>
                    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Short Description</label>
                    <textarea name="description" id="description" rows="2" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500"><?php echo e(old('description', $course->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-6">
                    <label for="body" class="block text-sm font-medium text-slate-700 mb-2">Detailed Content (Markdown Supported)</label>
                    <textarea name="body" id="body" rows="8" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 font-mono text-sm"><?php echo e(old('body', $course->body)); ?></textarea>
                    <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    <div>
                        <label for="zoom_url" class="block text-sm font-medium text-slate-700 mb-2">Zoom Meeting URL</label>
                        <input type="url" name="zoom_url" id="zoom_url" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="<?php echo e(old('zoom_url', $course->zoom_url)); ?>">
                        <?php $__errorArgs = ['zoom_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label for="youtube_url" class="block text-sm font-medium text-slate-700 mb-2">YouTube Preview URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="<?php echo e(old('youtube_url', $course->youtube_url)); ?>">
                        <?php $__errorArgs = ['youtube_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="mb-6">
                    <label for="tags" class="block text-sm font-medium text-slate-700 mb-2">Tags</label>
                    <input type="text" name="tags" id="tags" class="w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="<?php echo e(old('tags', is_array($course->tags) ? implode(', ', $course->tags) : $course->tags)); ?>">
                    <p class="mt-1 text-xs text-slate-500">Comma separated keywords.</p>
                    <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-500"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                 
                <div class="mb-6">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_public" value="1" class="rounded border-slate-300 text-sky-600 shadow-sm focus:ring-sky-500" <?php echo e(old('is_public', $course->is_public) ? 'checked' : ''); ?>>
                        <span class="text-sm font-medium text-slate-700">Public (Visible to students)</span>
                    </label>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <button type="button" onclick="confirm('Are you sure you want to delete this course?') || event.preventDefault(); document.getElementById('delete-course-form').submit();" class="text-red-600 hover:text-red-700 text-sm font-medium">
                        Delete Course
                    </button>

                    <div class="flex gap-3">
                        <a href="<?php echo e(route('trainer.courses.show', $course->slug)); ?>" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 rounded-md transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition-colors font-medium">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
            
            <form id="delete-course-form" action="<?php echo e(route('trainer.courses.destroy', $course->slug)); ?>" method="POST" class="hidden">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(request()->ajax() ? 'layouts.plain' : 'dashboards.shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/trainer/courses/edit.blade.php ENDPATH**/ ?>