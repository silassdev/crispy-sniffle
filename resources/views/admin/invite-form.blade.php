<div class="max-w-md">
  <form wire:submit.prevent="send">
    <div class="flex gap-2">
      <input wire:model.defer="email" type="email" placeholder="email@example.com" class="block w-full rounded border px-3 py-2" />
      <button type="submit" wire:loading.attr="disabled" class="px-4 py-2 bg-indigo-600 text-white rounded">
        <span wire:loading.remove>Invite</span>
        <span wire:loading>Sending…</span>
      </button>
    </div>
    @error('email') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
  </form>
</div>
