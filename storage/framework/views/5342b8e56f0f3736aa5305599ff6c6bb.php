<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href' => '#', 'icon' => 'view-grid', 'label' => '', 'component' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['href' => '#', 'icon' => 'view-grid', 'label' => '', 'component' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
  $icons = [
    'users' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 20v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'shield-check' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2l7 4v5c0 5-3.58 9-7 11-3.42-2-7-6-7-11V6l7-4z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 12l2 2 4-4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'academic-cap' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 14v7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'chat' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'document-text' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'chat-bubble-left-right' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M7 8h10M7 12h4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'view-grid' => '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="8" height="8" rx="1" stroke-width="1.5"/><rect x="13" y="3" width="8" height="8" rx="1" stroke-width="1.5"/><rect x="3" y="13" width="8" height="8" rx="1" stroke-width="1.5"/><rect x="13" y="13" width="8" height="8" rx="1" stroke-width="1.5"/></svg>',
  ];
  $svg = $icons[$icon] ?? $icons['view-grid'];
?>


<?php if($component): ?>
  <button
    type="button"
    class="dash-item w-full text-left"
    onclick="window.Livewire ? Livewire.emit('showSection','<?php echo e($component); ?>') : (function(){ location.href='<?php echo e($href); ?>' })()"
    title="<?php echo e($label); ?>"
  >
    <span class="inline-block align-middle"><?php echo $svg; ?></span>
    <span class="dash-label ml-3 truncate"><?php echo e($label); ?></span>
  </button>
<?php else: ?>
  <a href="<?php echo e($href); ?>" class="dash-item w-full text-left">
    <span class="inline-block align-middle"><?php echo $svg; ?></span>
    <span class="dash-label ml-3 truncate"><?php echo e($label); ?></span>
  </a>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/components/dash-item.blade.php ENDPATH**/ ?>