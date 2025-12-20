<div class="space-y-6">
  
  <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-2xl border border-purple-100">
    <form wire:submit.prevent="add">
      <div class="mb-4">
        <label class="block text-sm font-bold text-gray-700 mb-2">
          <?php echo e($replyTo ? 'Write your reply' : 'Write a comment'); ?>

        </label>
        <textarea 
          wire:model.defer="body" 
          rows="4" 
          class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all" 
          placeholder="<?php echo e($replyTo ? 'Share your thoughts on this comment...' : 'Share your thoughts on this post...'); ?>"
        ></textarea>
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
          <div class="mt-2 text-sm text-red-600 font-medium"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
      </div>

      <div class="flex items-center gap-3">
        <!--[if BLOCK]><![endif]--><?php if($replyTo): ?>
          <button 
            type="button" 
            wire:click="cancelReply" 
            class="px-5 py-2.5 border-2 border-gray-300 text-gray-700 font-bold rounded-full hover:bg-gray-100 transition-all"
          >
            Cancel Reply
          </button>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <button 
          type="submit" 
          class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-full hover:shadow-lg hover:scale-105 transition-all duration-300"
        >
          <span class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
            Post Comment
          </span>
        </button>
      </div>
    </form>
  </div>

  
  <div class="space-y-4">
    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="bg-white border-2 border-gray-100 rounded-2xl p-6 hover:border-purple-200 transition-all duration-300 shadow-sm hover:shadow-md">
        <div class="flex items-start gap-4">
          
          <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white font-bold text-lg shadow-md flex-shrink-0">
            <?php echo e(strtoupper(substr($comment->user->name ?? 'U', 0, 1))); ?>

          </div>

          <div class="flex-1 min-w-0">
            
            <div class="flex items-center justify-between mb-3">
              <div>
                <div class="font-bold text-gray-900 text-lg"><?php echo e($comment->user->name); ?></div>
                <div class="text-sm text-gray-500 font-medium mt-0.5">
                  <?php echo e($comment->created_at->diffForHumans()); ?>

                </div>
              </div>

              <button 
                wire:click="startReply(<?php echo e($comment->id); ?>)" 
                class="flex items-center gap-1.5 px-4 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold text-sm rounded-full transition-all hover:scale-105"
              >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
                Reply
              </button>
            </div>

            
            <div class="text-gray-700 leading-relaxed mb-4">
              <?php echo nl2br(e($comment->body)); ?>

            </div>

            
            <!--[if BLOCK]><![endif]--><?php if($comment->children->count()): ?>
              <div class="mt-4 space-y-3 pl-6 border-l-4 border-purple-200">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $comment->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="bg-purple-50/50 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                      
                      <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold text-sm shadow-sm flex-shrink-0">
                        <?php echo e(strtoupper(substr($child->user->name ?? 'U', 0, 1))); ?>

                      </div>

                      <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-2">
                          <div class="font-bold text-gray-900"><?php echo e($child->user->name); ?></div>
                          <div class="text-xs text-gray-500 font-medium">
                            <?php echo e($child->created_at->diffForHumans()); ?>

                          </div>
                        </div>
                        <div class="text-gray-700 leading-relaxed text-sm">
                          <?php echo nl2br(e($child->body)); ?>

                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
              </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="text-center py-12 bg-gray-50 rounded-2xl">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-purple-100 to-pink-100 mb-4">
          <svg class="w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No comments yet</h3>
        <p class="text-gray-600">Be the first to share your thoughts!</p>
      </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>

  
  <!--[if BLOCK]><![endif]--><?php if($comments->hasPages()): ?>
    <div class="mt-8">
      <?php echo e($comments->links()); ?>

    </div>
  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/comments/thread.blade.php ENDPATH**/ ?>