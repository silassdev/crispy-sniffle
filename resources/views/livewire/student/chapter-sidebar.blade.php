<div class="bg-white rounded shadow p-4">
  <div class="flex items-center justify-between mb-3">
    <div class="font-semibold text-sm">Course outline</div>
    <button wire:click="jumpToNextUnlocked" class="text-xs bg-indigo-600 text-white px-2 py-1 rounded">Jump to next unlocked</button>
  </div>

  @if(empty($chapters))
    <div class="text-sm text-gray-500">No chapters yet.</div>
  @else
    <ul class="space-y-2 text-sm">
      @foreach($chapters as $ch)
        <li class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
          <div class="flex items-center gap-2">
            <a href="{{ route('student.chapters.show', ['course' => $courseId, 'order' => $ch['order']]) }}"
               class="truncate {{ $currentOrder == $ch['order'] ? 'font-semibold' : '' }}">
              <span class="font-medium">#{{ $ch['order'] }}</span>
              <span class="ml-1 truncate">{{ $ch['title'] }}</span>
            </a>
          </div>

          <div class="flex items-center gap-2">
            @if(in_array($ch['id'], $completedIds))
              <span class="text-xs px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">Done</span>
            @else
              @if($ch['order'] > 1)
                @php
                  $prevDone = in_array($chapters[$ch['order'] - 2]['id'] ?? null, $completedIds);
                @endphp
                @if(!$prevDone)
                  <span class="text-xs px-2 py-0.5 rounded bg-yellow-100 text-yellow-700">Locked</span>
                @endif
              @endif
            @endif
          </div>
        </li>
      @endforeach
    </ul>
  @endif
</div>

<script>
  // listen for navigate events dispatched by Livewire component
  document.addEventListener('livewire:load', function () {
    window.addEventListener('navigate', function(e){
      if (e?.detail?.url) {
        window.location.href = e.detail.url;
      }
    });
  });
</script>
