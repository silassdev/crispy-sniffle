<div class="max-w-md mx-auto p-6 bg-white rounded shadow">
  <h2 class="text-xl font-semibold mb-4">Login</h2>

  <form wire:submit.prevent="submit" autocomplete="off">
    @csrf

    <div class="mb-3">
      <label class="block text-sm font-medium">Email</label>
      <input wire:model.defer="email" type="email" class="mt-1 block w-full rounded border-gray-200" required>
      @error('email') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Password</label>
      <input wire:model.defer="password" type="password" class="mt-1 block w-full rounded border-gray-200" required>
      @error('password') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
    </div>

    @if($errors->has('credentials'))
      <div class="text-sm text-red-600 mb-3">{{ $errors->first('credentials') }}</div>
    @endif
    @if($errors->has('too_many_attempts'))
      <div class="text-sm text-red-600 mb-3">{{ $errors->first('too_many_attempts') }}</div>
    @endif

    <div class="flex items-center justify-between gap-3">
      <button type="submit" wire:loading.attr="disabled" class="px-4 py-2 bg-indigo-600 text-white rounded">
        <span wire:loading.remove>Login</span>
        <span wire:loading>Logging in…</span>
      </button>

      <a href="{{ route('password.request') }}" class="text-sm text-gray-600">Forgot password?</a>
    </div>

    <div class="mt-4 text-sm text-gray-500">
      Or login with:
      <div class="flex gap-2 mt-2">
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="px-3 py-2 border rounded">Google</a>
        <a href="{{ route('social.redirect', ['provider' => 'github']) }}" class="px-3 py-2 border rounded">GitHub</a>
      </div>
    </div>
  </form>
</div>
