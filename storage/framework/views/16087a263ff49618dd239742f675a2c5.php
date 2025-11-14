<?php
    $role = $viewAs
        ?? session('view_as')
        ?? (auth()->user()->role ?? 'student');

    $colors = [
        'admin'   => 'bg-indigo-600 text-white',
        'trainer' => 'bg-emerald-600 text-white',
        'student' => 'bg-sky-600 text-white',
    ];

    $bg = $colors[$role] ?? 'bg-gray-700 text-white';
?>

<aside class="w-64 min-h-screen bg-white border-r">
  <div class="p-4">

    
    <div class="px-2 mb-4">
      <div class="rounded p-2 <?php echo e($bg); ?>">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 rounded bg-white/20 flex items-center justify-center text-sm font-bold">a</div>
          <div>
            <div class="font-semibold"><?php echo e(strtoupper($role)); ?> console</div>
            <div class="text-xs opacity-80">Quick actions</div>
          </div>
        </div>
      </div>
    </div>

    
    <nav class="space-y-1">
      <?php if($role === 'admin'): ?>
        <button
          onclick="emitShowSection('students', '<?php echo e(route('admin.students')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H6a4 4 0 01-4-4v-2h5m6 6v-6m0 0V9a4 4 0 00-4-4H6a4 4 0 00-4 4v6h5" />
            </svg>
          </span>
          <span class="dash-label">Students</span>
        </button>

        

        <button
          onclick="emitShowSection('admins', '<?php echo e(route('admin.admins')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4zM9 12l2 2 4-4" />
            </svg>
          </span>
          <span class="dash-label">Admins</span>
        </button>

        <button
          onclick="emitShowSection('trainers', '<?php echo e(route('admin.trainers')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l9 5-9 5-9-5 9-5zm0 10v6m-6-8v6a6 6 0 0012 0v-6" />
            </svg>
          </span>
          <span class="dash-label">Trainers</span>
        </button>

        <button
          onclick="emitShowSection('community', '<?php echo e(route('admin.community')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a4 4 0 01-4 4H8l-5 3V6a4 4 0 014-4h10a4 4 0 014 4v9z" />
            </svg>
          </span>
          <span class="dash-label">Community</span>
        </button>

        <button
          onclick="emitShowSection('comments', '<?php echo e(route('admin.comments')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h8M8 13h6M5 20l-3 2V6a3 3 0 013-3h10a3 3 0 013 3v10a3 3 0 01-3 3H5z" />
            </svg>
          </span>
          <span class="dash-label">Comments</span>
        </button>

        <button
          onclick="emitShowSection('posts', '<?php echo e(route('admin.posts')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h6M6 3h8l4 4v13a1 1 0 01-1 1H6a1 1 0 01-1-1V4a1 1 0 011-1z" />
            </svg>
          </span>
          <span class="dash-label">Posts</span>
        </button>

        <button
          onclick="emitShowSection('feedback', '<?php echo e(route('admin.feedback')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a4 4 0 01-4 4H8l-5 3V6a4 4 0 014-4h10a4 4 0 014 4v9z" />
            </svg>
          </span>
          <span class="dash-label">Feedback</span>
        </button>

        <button
          onclick="emitShowSection('other-actions', '<?php echo e(route('admin.other-actions')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z" />
            </svg>
          </span>
          <span class="dash-label">Other Actions</span>
        </button>

      <?php elseif($role === 'trainer'): ?>
        <button
          onclick="emitShowSection('courses', '<?php echo e(route('trainer.courses')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12M3 6h7a3 3 0 013 3v9H6a3 3 0 00-3 3V6zm18 0h-7a3 3 0 00-3 3v9h7a3 3 0 013 3V6z" />
            </svg>
          </span>
          <span class="dash-label">Courses</span>
        </button>
        

      <?php else: ?>
        <button
          onclick="emitShowSection('courses', '<?php echo e(route('student.courses')); ?>')"
          class="dash-item w-full text-left p-2 rounded hover:bg-gray-100 flex items-center gap-3">
          <span class="inline-block">
            
            <svg class="w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12M3 6h7a3 3 0 013 3v9H6a3 3 0 00-3 3V6zm18 0h-7a3 3 0 00-3 3v9h7a3 3 0 013 3V6z" />
            </svg>
          </span>
          <span class="dash-label">Courses</span>
        </button>
        
      <?php endif; ?>
    </nav>

  </div>
</aside>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/dashboards/partials/sidebar.blade.php ENDPATH**/ ?>