
<?php $__env->startSection('title', $course->title); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
  <div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <?php $img = $course->getFirstMediaUrl('illustration','thumb'); ?>
    <?php if($img): ?>
      <img src="<?php echo e($img); ?>" class="w-full h-56 object-cover rounded mb-4" alt="<?php echo e($course->title); ?>">
    <?php endif; ?>

    <h1 class="text-2xl font-bold"><?php echo e($course->title); ?></h1>
    <div class="text-sm text-gray-600"><?php echo e($course->excerpt); ?></div>
    <div class="mt-3 text-xs text-gray-500">By <?php echo e($course->trainer->name ?? 'Unknown'); ?> • ID: <?php echo e($course->course_id); ?></div>

    <div class="mt-6 prose max-w-none">
      <?php echo \Parsedown::instance()->text($course->body ?? ''); ?>

    </div>

    <?php if($course->youtube_url): ?>
      <div class="mt-4">
        <h4 class="font-semibold">Video</h4>
        <div class="aspect-video mt-2">
          <?php
            // attempt to convert youtube url to embed src
            $embed = null;
            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([A-Za-z0-9_\-]+)/', $course->youtube_url, $m)) {
              $embed = 'https://www.youtube.com/embed/'.$m[1];
            }
          ?>
          <?php if($embed): ?>
            <iframe src="<?php echo e($embed); ?>" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
          <?php else: ?>
            <a href="<?php echo e($course->youtube_url); ?>" target="_blank" class="text-indigo-600">Open video</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if($course->zoom_url): ?>
      <div class="mt-4">
        <h4 class="font-semibold">Zoom</h4>
        <div class="text-sm text-gray-700"><a href="<?php echo e($course->zoom_url); ?>" target="_blank" class="text-indigo-600">Open Zoom link</a></div>
      </div>
    <?php endif; ?>

    <?php if($course->getMedia('attachments')->count()): ?>
      <div class="mt-4">
        <h4 class="font-semibold">Attachments</h4>
        <ul class="mt-2 space-y-2">
          <?php $__currentLoopData = $course->getMedia('attachments'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e($att->getUrl()); ?>" class="text-indigo-600" target="_blank"><?php echo e($att->file_name); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="mt-6">
      <?php if(auth()->check()): ?>
        <form method="POST" action="<?php echo e(route('courses.enroll', $course->id)); ?>">
          <?php echo csrf_field(); ?>
          <button class="px-4 py-2 bg-indigo-600 text-white rounded">Enroll</button>
        </form>
      <?php else: ?>
        <?php if($course->is_public): ?>
          <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded">Enroll as guest</a>
        <?php else: ?>
          <div class="text-red-600 font-medium">Oops — you need to login to access this resource.</div>
          <a href="<?php echo e(route('login')); ?>" class="mt-3 inline-block text-indigo-600">Login</a>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewStudents', $course)): ?>
      <div class="mt-6">
        <h4 class="font-semibold">Enrolled students</h4>
        <ul class="mt-2">
          <?php $__currentLoopData = $course->enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <?php if($enr->user): ?>
                <?php echo e($enr->user->name); ?> (<?php echo e($enr->user->email); ?>)
              <?php else: ?>
                Guest — <?php echo e($enr->guest_email); ?>

              <?php endif; ?>
              <span class="text-xs text-gray-500"> • <?php echo e(optional($enr->enrolled_at)->diffForHumans()); ?></span>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/courses/show.blade.php ENDPATH**/ ?>