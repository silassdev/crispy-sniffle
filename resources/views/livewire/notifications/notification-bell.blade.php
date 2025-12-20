<div class="relative inline-block text-left">
  <a href="{{ route('notifications.index') }}" class="relative p-2 rounded hover:bg-gray-100 flex items-center">
    <svg class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @if($unreadCount > 0)
      <span class="absolute -top-1 -right-1 text-xs bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center">{{ $unreadCount }}</span>
    @endif
  </a>
</div>
