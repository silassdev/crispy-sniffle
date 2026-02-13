<div class="p-4">
  <div wire:loading wire:target="loadAnalytics" class="space-y-4">
    <div class="animate-pulse grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
      <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 5; $i++): ?>
        <div class="h-28 rounded-md bg-slate-200 dark:bg-slate-800 p-4">
          <div class="h-4 bg-slate-300 dark:bg-slate-700 rounded w-1/3 mb-3"></div>
          <div class="h-8 bg-slate-300 dark:bg-slate-700 rounded w-1/2"></div>
        </div>
      <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
  </div>

  <div wire:loading.remove wire:target="loadAnalytics">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
      <div>
        <h2 class="text-1xl sm:text-1xl font-bold leading-tight text-gray-600 dark:text-green">Trainer Overview</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Your teaching metrics and student performance.</p>
      </div>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
      <?php
        $metrics = [
          ['label'=>'Courses Taught','key'=>'courses_taught','icon'=>'📚','color'=>'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/20'],
          ['label'=>'Total Students','key'=>'total_students','icon'=>'👥','color'=>'bg-blue-50 text-blue-600 dark:bg-blue-900/20'],
          ['label'=>'Pending Grading','key'=>'pending_assignments','icon'=>'📝','color'=>'bg-amber-50 text-amber-600 dark:bg-amber-900/20'],
          ['label'=>'Graded','key'=>'completed_assignments','icon'=>'✅','color'=>'bg-green-50 text-green-600 dark:bg-green-900/20'],
          ['label'=>'Avg Completion','key'=>'average_course_completion','icon'=>'📊','color'=>'bg-purple-50 text-purple-600 dark:bg-purple-900/20', 'suffix' => '%'],
        ];
      ?>

      <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $metrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="relative rounded-md p-4 <?php echo e($metric['color']); ?> border border-slate-200 dark:border-slate-700 shadow-sm">
        <div class="flex items-start justify-between gap-3">
          <div class="flex-1 min-w-0">
            <div class="text-sm opacity-75 truncate mb-1"><?php echo e($metric['label']); ?></div>
            <div class="text-2xl font-bold">
              <?php echo e($analytics[$metric['key']] ?? 0); ?><?php echo e($metric['suffix'] ?? ''); ?>

            </div>
          </div>
          <div class="text-3xl opacity-50"><?php echo e($metric['icon']); ?></div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    
    <!--[if BLOCK]><![endif]--><?php if(!empty($analytics['courses'])): ?>
    <div class="mb-8">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Your Courses</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $analytics['courses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white dark:bg-slate-800 rounded-lg p-4 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
          <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-2"><?php echo e($course['name']); ?></h4>
          <div class="space-y-2">
            <div class="flex justify-between text-sm">
              <span class="text-slate-600 dark:text-slate-400">Students:</span>
              <span class="font-medium"><?php echo e($course['students']); ?></span>
            </div>
            <div>
              <div class="flex justify-between text-sm mb-1">
                <span class="text-slate-600 dark:text-slate-400">Progress:</span>
                <span class="font-medium"><?php echo e($course['progress']); ?>%</span>
              </div>
              <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                <div class="bg-emerald-600 h-2 rounded-full" style="width: <?php echo e($course['progress']); ?>%"></div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <!--[if BLOCK]><![endif]--><?php if(!empty($analytics['recent_activity'])): ?>
    <div>
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Recent Student Activity</h3>
      <div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="divide-y divide-slate-200 dark:divide-slate-700">
          <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $analytics['recent_activity']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
            <div class="flex items-center justify-between">
              <div class="flex-1">
                <p class="text-sm text-gray-800 dark:text-gray-200">
                  <span class="font-medium"><?php echo e($activity['user']); ?></span>
                  <span class="text-slate-600 dark:text-slate-400"><?php echo e($activity['action']); ?></span>
                  <span class="text-emerald-600 dark:text-emerald-400"><?php echo e($activity['course']); ?></span>
                </p>
              </div>
              <span class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($activity['time']); ?></span>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>
      </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/trainer/overview.blade.php ENDPATH**/ ?>