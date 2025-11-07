<div class="max-w-md">
  <form wire:submit.prevent="send">
    <div class="flex gap-2">
      <input wire:model.defer="email" type="email" placeholder="email@example.com" class="block w-full rounded border px-3 py-2" />
      <button type="submit" wire:loading.attr="disabled" class="px-4 py-2 bg-indigo-600 text-white rounded">
        <span wire:loading.remove>Invite</span>
        <span wire:loading>Sending…</span>
      </button>
    </div>
    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-500 mt-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
  </form>
</div><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views\livewire/admin/invite-form.blade.php ENDPATH**/ ?>