<div class="bg-white rounded shadow p-4">
  <header class="flex items-center justify-between">
    <div>
      <h3 class="font-semibold">{{ $chapter->title }}</h3>
      <div class="text-xs text-gray-500">{{ $chapter->description }}</div>
    </div>
    <div class="text-sm">
      @if($completed)
        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs">Completed</span>
      @else
        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Not completed</span>
      @endif
    </div>
  </header>

  <div class="mt-4 prose max-w-none">
    {!! \Illuminate\Support\Str::markdown($chapter->content ?? '') !!}
  </div>

  <div class="mt-4 grid grid-cols-3 gap-2 items-center">
    <div>
      @if($prev)
        <button wire:click="goTo({{ $prev }})" class="px-3 py-2 border rounded">← Previous</button>
      @endif
    </div>

    <div class="text-center">
      <small class="text-xs text-gray-500">Chapter {{ $chapter->order }} of {{ $max }}</small>
    </div>

    <div class="text-right">
      <button wire:click="markComplete" class="px-3 py-2 bg-emerald-600 text-white rounded" @if($completed) disabled @endif>
        Mark complete
      </button>

      @if($next)
        {{-- show next but disable if not unlocked --}}
        <button wire:click="goTo({{ $next }})" class="px-3 py-2 border rounded ml-2"
          @if(! $this->canOpenOrder($next)) disabled @endif>Next →
        </button>
      @endif
    </div>
  </div>

  <div class="mt-4">
    {{-- attachments via Spatie media --}}
    @if($chapter->getMedia('resources')->count())
      <h5 class="font-medium text-sm">Resources</h5>
      <ul class="list-disc pl-6 text-sm">
        @foreach($chapter->getMedia('resources') as $res)
          <li><a href="{{ $res->getUrl() }}" class="text-indigo-600" target="_blank">{{ $res->file_name }}</a></li>
        @endforeach
      </ul>
    @endif
  </div>
</div>
