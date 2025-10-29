@extends('layouts.app')
@section('title','Choose a new password')
@section('content')
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Choose a new password</h2>

    @if(session('status'))
      <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    @if($errors->any())
      <div class="mb-4 text-red-600">{{ $errors->first() }}</div>
    @endif

    <form id="password-reset-form" method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}" />

      <label class="block text-sm mb-1">Email</label>
      <p class="mb-3 text-sm text-gray-700" aria-live="polite">{{ $email }}</p>
      <input type="hidden" name="email" value="{{ $email }}">

      <label class="block text-sm mb-1">New password</label>
      <input name="password" required autocomplete="new-password" type="password" placeholder="At least 6 characters" class="w-full border p-2 rounded mb-3" />
      @error('password')
        <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
      @enderror

      <label class="block text-sm mb-1">Confirm password</label>
      <input name="password_confirmation" required autocomplete="new-password" type="password" placeholder="Repeat password" class="w-full border p-2 rounded mb-4" />

      <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded">Reset password</button>
    </form>
  </div>
  
  <script>
document.getElementById('password-reset-form')?.addEventListener('submit', function(e){
  window.showLoader();
  var btn = this.querySelector('button[type="submit"]');
  if(btn){ btn.disabled = true; btn.classList.add('opacity-60','cursor-not-allowed'); }
});
</script>

@endsection
