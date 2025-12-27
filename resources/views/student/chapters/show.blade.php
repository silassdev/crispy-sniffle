@extends('layouts.app')
@section('title', $course->title . ' — Chapter ' . $order)

@section('content')
  <div class="max-w-5xl mx-auto px-4 py-6">
    <div class="mb-4 flex items-center justify-between">
      <div>
        <h1 class="text-xl font-semibold">{{ $course->title }}</h1>
        <div class="text-sm text-gray-500">Chapter {{ $order }} • {{ $course->trainer->name ?? '' }}</div>
      </div>

      <div class="flex items-center gap-3">
        <a href="{{ route('student.courses') }}" class="text-sm text-gray-600">My courses</a>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
      {{-- main viewer --}}
      <div class="col-span-12 lg:col-span-8">
        {{-- main Livewire viewer; passes courseId and order to component --}}
        @livewire('student.chapter-viewer', ['courseId' => $course->id, 'order' => $order])
      </div>

      {{-- right sidebar: course outline / progress --}}
      <aside class="col-span-12 lg:col-span-4">
        <div class="bg-white rounded shadow p-4 mb-4">
          <div class="font-semibold text-sm mb-2">Course outline</div>

          @php
            $chapters = $course->chapters()->orderBy('order')->get();
            $completedIds = \DB::table('chapter_completions')->where('user_id', auth()->id())->whereIn('chapter_id', $chapters->pluck('id'))->pluck('chapter_id')->toArray();
          @endphp

          @if($chapters->isEmpty())
            <div class="text-sm text-gray-500">No chapters yet.</div>
          @else
            <ul class="space-y-2 text-sm">
              @foreach($chapters as $ch)
                <li class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                  <div class="flex items-center gap-2">
                    <a href="{{ route('student.chapters.show', ['course' => $course->id, 'order' => $ch->order]) }}" class="truncate">
                      <span class="font-medium">#{{ $ch->order }} {{ $ch->title }}</span>
                    </a>
                  </div>

                  <div class="flex items-center gap-2">
                    @if(in_array($ch->id, $completedIds))
                      <span class="text-xs px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">Done</span>
                    @else
                      @if($ch->order > 1)
                        {{-- locked indicator if previous not completed (client-side check will prevent access too) --}}
                        @php
                          $prev = $chapters->firstWhere('order', $ch->order - 1);
                          $prevDone = $prev ? in_array($prev->id, $completedIds) : true;
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

        {{-- progress summary --}}
        <div class="bg-white rounded shadow p-4">
          @php
            $total = $chapters->count();
            $done = count($completedIds);
            $pct = $total ? round(($done / $total) * 100) : 0;
          @endphp
          <div class="flex items-center justify-between text-sm mb-2">
            <div>Progress</div>
            <div>{{ $done }} / {{ $total }}</div>
          </div>

          <div class="w-full bg-gray-100 h-2 rounded overflow-hidden">
            <div style="width: {{ $pct }}%;" class="h-2 bg-emerald-500"></div>
          </div>
          <div class="text-xs text-gray-500 mt-2">{{ $pct }}% complete</div>
        </div>
      </aside>
    </div>
  </div>
@endsection
