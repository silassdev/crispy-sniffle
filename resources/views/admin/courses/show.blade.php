@extends('dashboards.shell')
@section('content')
<div class="max-w-6xl mx-auto p-4">
  <h1 class="text-2xl font-semibold">{{ $course->title }}</h1>
  <div class="text-sm text-gray-600">Trainer: {{ $course->trainer->name }}</div>
  <div class="mt-4 grid grid-cols-4 gap-6">
    <div class="col-span-3">
      <div class="bg-white rounded shadow p-4">
        <h4 class="font-semibold">Course details</h4>
        <div class="mt-2 text-sm">{!! nl2br(e($course->description)) !!}</div>
      </div>

      <div class="mt-4 bg-white rounded shadow p-4">
        <h4 class="font-semibold">Chapters ({{ $chapterCount }})</h4>
        <ul class="mt-3 space-y-2">
          @foreach($course->chapters as $ch)
            <li class="border rounded p-3 flex justify-between items-center">
              <div>
                <div class="font-medium">#{{ $ch->order }} {{ $ch->title }}</div>
                <div class="text-xs text-gray-500">{{ $ch->description }}</div>
              </div>
              <div class="text-xs text-gray-500">{{ $ch->completions()->count() }} completions</div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

    <aside class="col-span-1">
      <div class="bg-white rounded shadow p-4">
        <div class="text-xs text-gray-500">Students</div>
        <div class="text-2xl font-bold">{{ $studentsCount }}</div>
      </div>
    </aside>
  </div>
</div>
@endsection
