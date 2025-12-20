<div class="space-y-4">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Community & Posts</h1>
    <div>
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.community-notifications', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2478435128-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
  </div>
  <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.community-manager', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2478435128-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/admin/community-fragment.blade.php ENDPATH**/ ?>