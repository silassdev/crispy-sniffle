<div class="flex items-center justify-between mb-4">
  <div class="flex items-center gap-3">
    <img src="/assets/logo.svg" alt="App" class="w-8 h-8"/>
    <h1 class="text-xl font-semibold">Jobs</h1>
  </div>
</div>

<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.job-manager', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1141912925-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/jobs/index-fragment.blade.php ENDPATH**/ ?>