<div class="space-y-6">

  
  <div class="flex items-center justify-between gap-4">
    <div class="flex items-center gap-4">
      <div class="px-3 py-2 bg-white rounded shadow-sm">
        <div class="text-xs text-gray-500">Total posts</div>
        <div class="text-lg font-semibold"><?php echo e($counters['total_posts'] ?? '—'); ?></div>
      </div>
      <div class="px-3 py-2 bg-white rounded shadow-sm">
        <div class="text-xs text-gray-500">Published</div>
        <div class="text-lg font-semibold"><?php echo e($counters['published'] ?? '—'); ?></div>
      </div>
      <div class="px-3 py-2 bg-white rounded shadow-sm">
        <div class="text-xs text-gray-500">Drafts</div>
        <div class="text-lg font-semibold"><?php echo e($counters['drafts'] ?? '—'); ?></div>
      </div>
    </div>

    <div class="flex items-center gap-3">
      <a href="<?php echo e(route('blogs.index')); ?>" class="px-3 py-2 bg-indigo-600 text-white rounded text-sm">View public blog feed</a>
      <a href="<?php echo e(route('admin.posts')); ?>" class="px-3 py-2 border rounded text-sm">Manage all posts</a>
    </div>
  </div>

  
  <div class="bg-white p-4 rounded shadow-sm">
    <h3 class="font-semibold mb-2">What's on your mind?</h3>

    <div class="space-y-3">
      <input type="text" wire:model.defer="form.title" placeholder="Title (optional)" class="w-full border rounded px-3 py-2" />

      <textarea wire:model.defer="form.body" rows="4" placeholder="Write something to share with the community..." class="w-full border rounded px-3 py-2"></textarea>
      <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-xs text-red-600"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

      <div class="flex items-center gap-3">
        <input type="text" wire:model.defer="form.tags" placeholder="Tags, comma separated" class="border rounded px-2 py-1" />
        <input type="file" wire:model="featureImage" accept="image/*" class="hidden" id="cm-feature-file"/>
        <label for="cm-feature-file" class="px-3 py-1 border rounded cursor-pointer text-sm">Add image</label>

        <div class="ml-auto flex items-center gap-2">
          <button wire:click.prevent="confirm('save-draft')" class="px-3 py-1 border rounded text-sm">Save draft</button>
          <button wire:click.prevent="confirm('publish')" class="px-3 py-1 bg-emerald-600 text-white rounded text-sm">Publish now</button>
          <button wire:click.prevent="resetForm" class="px-3 py-1 border rounded text-sm">Abandon</button>
        </div>
      </div>
    </div>
  </div>

  
  <div x-data="{ open:false }"
       x-on:open-confirm-modal.window="open=true"
       x-show="open"
       x-cloak
       class="fixed inset-0 z-50 flex items-center justify-center bg-black/30">
    <div class="bg-white rounded p-6 w-full max-w-md">
      <h4 class="font-semibold mb-2">Confirm</h4>
      <p class="text-sm text-gray-700 mb-4">
        Are you sure you want to <?php echo e($confirmAction === 'publish' ? 'publish' : ($confirmAction === 'save-draft' ? 'save as draft' : ($confirmAction === 'delete-post' ? 'delete this post' : ($confirmAction === 'ban-user' ? 'ban this user' : 'perform this action')) )); ?>?
      </p>
      <div class="flex justify-end gap-3">
        <button @click="open=false; Livewire.emit('cancelConfirm')" class="px-3 py-2 border rounded">Cancel</button>
        <button @click="open=false; Livewire.emit('runConfirmedAction')" class="px-3 py-2 bg-indigo-600 text-white rounded">Yes</button>
      </div>
    </div>
  </div>

  
  <div wire:init="loadPosts" class="space-y-4">
    <!--[if BLOCK]><![endif]--><?php if(! $readyToLoad): ?>
      
      <div class="space-y-3">
        <!--[if BLOCK]><![endif]--><?php for($i=0;$i<3;$i++): ?>
          <div class="animate-pulse bg-white p-4 rounded shadow-sm">
            <div class="h-4 bg-gray-200 rounded w-1/3 mb-3"></div>
            <div class="h-3 bg-gray-200 rounded w-full mb-2"></div>
            <div class="h-3 bg-gray-200 rounded w-5/6"></div>
          </div>
        <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
      </div>
    <?php else: ?>
      <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white p-4 rounded shadow-sm">
          <div class="flex items-start gap-4">
            <div class="flex-1">
              <div class="flex items-start justify-between">
                <div>
                  <h4 class="font-semibold">
                    <a href="<?php echo e(route('blogs.show', $post->slug)); ?>" target="_blank"><?php echo e($post->title ?: Str::limit(strip_tags($post->body), 60)); ?></a>
                  </h4>
                  <div class="text-xs text-gray-500">By <?php echo e($post->author->name); ?> • <?php echo e($post->created_at->diffForHumans()); ?></div>
                </div>
                <div class="flex items-center gap-2">
                  <a href="<?php echo e(route('admin.trainers.show', $post->author_id)); ?>" class="text-sm text-gray-500">Author</a>
                  <button wire:click="confirm('delete-post', <?php echo e($post->id); ?>)" class="text-sm text-red-600">Delete</button>
                </div>
              </div>

              <div class="mt-3 text-gray-700">
                <?php echo Str::limit(strip_tags($post->body), 250); ?>

              </div>

              <div class="mt-3 flex items-center gap-3">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span class="text-xs bg-gray-100 px-2 py-1 rounded"><?php echo e($tag->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <a href="<?php echo e(route('blogs.show', $post->slug)); ?>" class="ml-auto text-indigo-600 text-sm">Open →</a>
              </div>

              <div class="mt-3 flex items-center gap-3 text-xs text-gray-500">
                <div><?php echo e($post->comments()->count()); ?> comments</div>
                <div>|</div>
                <button wire:click.prevent="$emit('openComments',{id: <?php echo e($post->id); ?>})" class="text-sm">Manage comments</button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center text-gray-500 bg-white p-6 rounded">No community posts yet.</div>
      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

      <div>
        <?php echo e($posts->links()); ?>

      </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
  // small helper so Livewire events work with the modal
  Livewire.on('open-confirm-modal', () => {});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/admin/community-manager.blade.php ENDPATH**/ ?>