{{-- resources/views/profile/social-links.blade.php --}}
@php
    $providers = ['google' => 'Google', 'github' => 'GitHub', 'facebook' => 'Facebook'];
    $linked = auth()->user()->socialAccounts->keyBy('provider_name');
@endphp

<div class="bg-white dark:bg-gray-800 border rounded-lg p-4">
  <h3 class="font-semibold mb-3">Linked accounts</h3>

  <div class="space-y-3">
    @foreach($providers as $key => $label)
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-sm font-medium">
            {{ strtoupper(substr($label,0,1)) }}
          </div>
          <div>
            <div class="font-medium">{{ $label }}</div>
            <div class="text-xs text-gray-500">
              @if(isset($linked[$key]) && $linked[$key]->provider_email)
                Linked as {{ $linked[$key]->provider_email }}
              @elseif(isset($linked[$key]))
                Linked
              @else
                Not linked
              @endif
            </div>
          </div>
        </div>

        <div>
          @if(isset($linked[$key]))
            <form method="POST" action="{{ route('social.link.unlink') }}" onsubmit="return confirm('Unlink {{ $label }}?');">
              @csrf
              <input type="hidden" name="provider" value="{{ $key }}">
              <button type="submit" class="px-3 py-1 text-sm border rounded text-red-600">Unlink</button>
            </form>
          @else
            <a href="{{ route('social.link', ['provider' => $key]) }}" class="px-3 py-1 text-sm border rounded hover:bg-gray-50">Link</a>
          @endif
        </div>
      </div>
    @endforeach
  </div>
</div>
