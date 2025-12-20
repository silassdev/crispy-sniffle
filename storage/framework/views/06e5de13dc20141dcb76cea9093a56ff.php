<?php
  // This view is for the courses list in the admin panel
?>
<div class="space-y-4">
  <header class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold text-slate-800">Courses</h1>
  </header>
  
  <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.course-list', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2794702449-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/courses-fragment.blade.php ENDPATH**/ ?>