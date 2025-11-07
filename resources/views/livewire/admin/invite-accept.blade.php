<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
  @if(! $valid)
    <div class="text-center text-red-600">Invitation invalid or expired.</div>
  @else
    <h3 class="text-lg font-semibold mb-3">Set an admin password for {{ $email }}</h3>

    <form wire:submit.prevent="submit">
      <div class="mb-3">
        <label class="block text-sm">Password</label>
        <input wire:model.defer="password" type="password" autocomplete="new-password" class="mt-1 block w-full rounded border px-3 py-2" />
        @error('password') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="block text-sm">Confirm password</label>
        <input wire:model.defer="password_confirmation" type="password" autocomplete="new-password" class="mt-1 block w-full rounded border px-3 py-2" />
      </div>

      <div class="flex justify-end gap-2">
        <button class="px-4 py-2 border rounded" type="button" onclick="window.location='{{ route('home') }}'">Cancel</button>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded" type="submit" wire:loading.attr="disabled">
          <span wire:loading.remove>Set password & continue</span>
          <span wire:loading>Working…</span>
        </button>
      </div>
    </form>
  @endif
</div>
