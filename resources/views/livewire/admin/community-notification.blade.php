<div class="relative">
  <button class="p-2 rounded hover:bg-gray-100">
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <span class="inline-block ml-1 text-xs text-red-600">{{ $unread->count() }}</span>
  </button>

  {{-- simple dropdown --}}
  <div class="absolute right-0 mt-2 w-80 bg-white shadow rounded z-20">
    <div class="p-3 text-sm">
      @forelse($unread as $n)
        <div class="py-2 border-b last:border-b-0">
          <div class="font-medium">{{ $n->data['title'] ?? 'Notification' }}</div>
          <div class="text-xs text-gray-500">{{ Str::limit($n->data['message'] ?? '', 80) }}</div>
        </div>
      @empty
        <div class="py-3 text-center text-gray-500">No unread notifications</div>
      @endforelse
    </div>
  </div>
</div>
