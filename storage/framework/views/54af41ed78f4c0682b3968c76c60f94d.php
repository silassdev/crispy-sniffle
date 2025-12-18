<div class="space-y-4">
  
  <div class="bg-white p-4 rounded shadow-sm">
    <form wire:submit.prevent="add">
      <textarea wire:model.defer="body" rows="3" class="w-full border rounded px-3 py-2" placeholder="<?php echo e($replyTo ? 'Write your reply...' : 'Write a comment...'); ?>"></textarea>
      <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-600 mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

      <div class="flex items-center gap-3 mt-3">
        <!--[if BLOCK]><![endif]--><?php if($replyTo): ?>
          <button type="button" wire:click="cancelReply" class="px-3 py-1 border rounded">Cancel Reply</button>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Post</button>
      </div>
    </form>
  </div>

  
  <div class="space-y-4">
    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="bg-white p-4 rounded shadow-sm">
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center text-sm font-bold"><?php echo e(strtoupper(substr($comment->user->name ?? 'U',0,1))); ?></div>
          <div class="flex-1">
            <div class="flex items-center justify-between">
              <div>
                <div class="font-semibold"><?php echo e($comment->user->name); ?></div>
                <div class="text-xs text-gray-500"><?php echo e($comment->created_at->diffForHumans()); ?></div>
              </div>

              <div class="text-sm">
                <button wire:click="startReply(<?php echo e($comment->id); ?>)" class="text-indigo-600">Reply</button>
              </div>
            </div>

            <div class="mt-2 text-gray-700"><?php echo nl2br(e($comment->body)); ?></div>

            
            <!--[if BLOCK]><![endif]--><?php if($comment->children->count()): ?>
              <div class="mt-3 space-y-3 pl-6 border-l">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $comment->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div>
                    <div class="flex items-start gap-3">
                      <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-xs font-medium"><?php echo e(strtoupper(substr($child->user->name ?? 'U',0,1))); ?></div>
                      <div>
                        <div class="text-sm font-semibold"><?php echo e($child->user->name); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($child->created_at->diffForHumans()); ?></div>
                        <div class="mt-1 text-gray-700"><?php echo nl2br(e($child->body)); ?></div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
              </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
  </div>

  <div>
    <?php echo e($comments->links()); ?>

  </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/comments/thread.blade.php ENDPATH**/ ?>