<div>
  {{-- modal --}}
  <div x-data x-show.transition.opacity="@entangle('show')" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="bg-white rounded shadow-lg z-10 w-full max-w-2xl p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold">Create question</h3>
        <button @click="$wire.show = false" class="text-gray-500">✕</button>
      </div>

      <div class="space-y-3">
        <div>
          <label class="block text-sm">Type</label>
          <select wire:model="type" class="block w-full border rounded px-3 py-2">
            <option value="mcq_single">MCQ (single)</option>
            <option value="mcq_multi">MCQ (multiple)</option>
            <option value="true_false">True / False</option>
            <option value="short_answer">Short answer</option>
          </select>
        </div>

        <div>
          <label class="block text-sm">Question text</label>
          <textarea wire:model.defer="question_text" class="block w-full border rounded p-2"></textarea>
          @error('question_text') <div class="text-xs text-red-500">{{ $message }}</div> @enderror
        </div>

        @if(in_array($type, ['mcq_single','mcq_multi','true_false']))
          <div>
            <div class="flex items-center justify-between">
              <label class="block text-sm">Options</label>
              <button type="button" wire:click="addOption" class="text-sm text-blue-600">Add Option</button>
            </div>

            <div class="space-y-2 mt-2">
              @foreach($options as $idx => $opt)
                <div class="flex items-center gap-2">
                  <input type="text" wire:model.defer="options.{{ $idx }}.text" class="flex-1 border rounded px-2 py-1" placeholder="Option text" />
                  <label class="flex items-center gap-1 text-sm">
                    <input type="{{ $type === 'mcq_multi' ? 'checkbox' : 'radio' }}" wire:model.defer="options.{{ $idx }}.is_correct" />
                    <span class="text-xs">Correct</span>
                  </label>
                  <button type="button" wire:click="removeOption({{ $idx }})" class="text-red-600">Remove</button>
                </div>
              @endforeach
            </div>
          </div>
        @endif

        <div class="flex justify-end gap-2 mt-4">
          <button type="button" wire:click="$set('show', false)" class="px-3 py-2 border rounded">Cancel</button>
          <button type="button" wire:click="save" wire:loading.attr="disabled" class="px-3 py-2 bg-indigo-600 text-white rounded">
            <span wire:loading.remove>Save</span>
            <span wire:loading>@include('components.donut-loader-small')</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
