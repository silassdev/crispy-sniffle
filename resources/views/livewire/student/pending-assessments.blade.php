<div class="bg-white rounded shadow p-3">
  <div class="flex items-center justify-between gap-3">
    <div class="flex items-center gap-3">
      <div class="text-sm font-semibold">Pending assessments</div>

      {{-- compact badge count (red if >0) --}}
      <div aria-hidden="true">
        @if($count > 0)
          <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-red-600 text-white">
            {{ $count }}
          </span>
        @else
          <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
            0
          </span>
        @endif
      </div>
    </div>

    <div class="flex items-center gap-2">
      @if(!$showAll)
        <button wire:click="viewAll" class="text-xs text-indigo-600 hover:underline">View all</button>
      @else
        <a href="{{ route('student.dashboard') }}" class="text-xs text-gray-500 hover:underline">Back</a>
      @endif
    </div>
  </div>

  <div class="mt-3">
    @if($assessments->isEmpty())
      <div class="text-sm text-gray-500">No pending assessments. Good job!</div>
    @else
      <ul class="space-y-3">
        @foreach($assessments as $a)
          <li class="p-3 border rounded flex items-start justify-between">
            <div class="flex-1">
              <div class="font-medium text-sm">{{ $a->title }}</div>
              <div class="text-xs text-gray-500">{{ $a->course->title ?? 'Course' }} • {{ ucfirst($a->type) }}</div>
              @if($a->due_at)
                <div class="text-xs text-red-600 mt-1">Due: {{ $a->due_at->diffForHumans() }} ({{ $a->due_at->toDayDateTimeString() }})</div>
              @endif
            </div>

            <div class="flex items-center gap-2 ml-4">
              @if($showAll)
                <a href="{{ route('courses.show', $a->course->slug) }}" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded">Open</a>
              @else
                <button wire:click="viewAll" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded">Open</button>
              @endif
            </div>
          </li>
        @endforeach
      </ul>

      {{-- pagination controls (only when showAll) --}}
      @if($showAll)
        <div class="mt-4">
          {{ $assessments->links() }}
        </div>
      @else
        <div class="mt-3 text-xs text-gray-500">Showing up to {{ $limit }} items.</div>
      @endif
    @endif
  </div>
</div>
