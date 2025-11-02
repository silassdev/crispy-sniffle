<div class="max-w-md mx-auto p-6 bg-white rounded shadow">
  <h2 class="text-xl font-semibold mb-4">Create an account</h2>

  <form wire:submit.prevent="submit" autocomplete="off">
    @csrf

    <div class="mb-3">
      <label class="block text-sm font-medium">I am signing up as</label>
      <div class="flex gap-2 mt-2">
        <label class="inline-flex items-center gap-2 px-3 py-2 border rounded cursor-pointer">
          <input type="radio" wire:model="role" value="student" class="hidden" checked>
          <span class="font-medium">Student</span>
        </label>
        <label class="inline-flex items-center gap-2 px-3 py-2 border rounded cursor-pointer">
          <input type="radio" wire:model="role" value="trainer" class="hidden">
          <span class="font-medium">Trainer (requires approval)</span>
        </label>
      </div>
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Name</label>
      <input wire:model.defer="name" required class="mt-1 block w-full rounded border-gray-200">
      @error('name') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Email</label>
      <input wire:model.defer="email" type="email" required class="mt-1 block w-full rounded border-gray-200">
      @error('email') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Password</label>
      <input wire:model.defer="password" type="password" required class="mt-1 block w-full rounded border-gray-200">
      @error('password') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Confirm Password</label>
      <input wire:model.defer="password_confirmation" type="password" required class="mt-1 block w-full rounded border-gray-200">
    </div>

    <div class="flex items-center gap-3">
      <button type="submit" wire:loading.attr="disabled" class="px-4 py-2 bg-indigo-600 text-white rounded">
        <span wire:loading.remove>Register</span>
        <span wire:loading>Submitting…</span>
      </button>
      <a href="{{ route('login') }}" class="text-sm text-gray-600">Already have an account?</a>
    </div>

    <div class="mt-4 text-sm text-gray-500">
      Or sign up using:
      <div class="flex gap-2 mt-2">
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}?role={{ $role }}" class="px-3 py-2 border rounded">Google</a>
        <a href="{{ route('social.redirect', ['provider' => 'github']) }}?role={{ $role }}" class="px-3 py-2 border rounded">GitHub</a>
      </div>
    </div>
  </form>
</div>
