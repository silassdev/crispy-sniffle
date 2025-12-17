<div class="space-y-6 bg-white p-6 rounded shadow-sm">
  <div class="flex items-center justify-between">
    <h3 class="text-lg font-semibold">{{ $post ? 'Edit Post' : 'Create Post' }}</h3>
    <div class="text-sm text-gray-500">{{ $post ? 'ID: '.$post->id : '' }}</div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" wire:model.defer="form.title" class="mt-1 block w-full border rounded px-3 py-2" />
        @error('form.title') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Excerpt</label>
        <textarea wire:model.defer="form.excerpt" rows="3" class="mt-1 block w-full border rounded px-3 py-2"></textarea>
        @error('form.excerpt') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Body (HTML allowed)</label>
        <textarea wire:model.defer="form.body" rows="12" class="mt-1 block w-full border rounded px-3 py-2"></textarea>
        @error('form.body') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
      </div>
    </div>

    <aside class="bg-gray-50 p-4 rounded space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select wire:model="form.status" class="mt-1 block w-full border rounded px-3 py-2">
          <option value="draft">Draft</option>
          <option value="published">Published</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Feature image</label>
        @if($post && $post->feature_image)
          <div class="mt-2">
            <img src="{{ asset('storage/'.$post->feature_image) }}" class="w-full h-40 object-cover rounded" alt="feature">
            <div class="flex gap-2 mt-2">
              <button wire:click="removeFeatureImage" class="px-3 py-1 bg-red-600 text-white rounded text-sm">Remove</button>
            </div>
          </div>
        @endif

        <div class="mt-2">
          <input type="file" wire:model="featureImage" />
          @error('featureImage') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
          <div wire:loading wire:target="featureImage" class="text-xs text-gray-500 mt-1">Uploading...</div>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Tags (comma separated)</label>
        <input type="text" wire:model.defer="form.tags" class="mt-1 block w-full border rounded px-3 py-2" />
        <div class="text-xs text-gray-500 mt-1">Examples: laravel, livewire, javascript</div>
      </div>

      <div class="pt-3">
        <button wire:click="save" wire:loading.attr="disabled" class="w-full px-4 py-2 bg-indigo-600 text-white rounded">
          <span wire:loading wire:target="save" class="loader inline-block mr-2"></span> Save post
        </button>
      </div>
    </aside>
  </div>
</div>

<style>
.loader { width: 14px; height: 14px; border: 2px solid rgba(255,255,255,0.3); border-top-color: rgba(255,255,255,1); border-radius: 50%; display:inline-block; animation: spin .9s linear infinite;}
@keyframes spin{to{transform:rotate(360deg)}}
</style>
