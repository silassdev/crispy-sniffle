@extends('layouts.app')
@section('title', $course->title)

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    @php $img = $course->getFirstMediaUrl('illustration','thumb'); @endphp
    @if($img)
      <img src="{{ $img }}" class="w-full h-56 object-cover rounded mb-4" alt="{{ $course->title }}">
    @endif

    <h1 class="text-2xl font-bold">{{ $course->title }}</h1>
    <div class="text-sm text-gray-600">{{ $course->excerpt }}</div>
    <div class="mt-3 text-xs text-gray-500">By {{ $course->trainer->name ?? 'Unknown' }} • ID: {{ $course->course_id }}</div>

    <div class="mt-6 prose max-w-none">
      {!! \Parsedown::instance()->text($course->body ?? '') !!}
    </div>

    @if($course->youtube_url)
      <div class="mt-4">
        <h4 class="font-semibold">Video</h4>
        <div class="aspect-video mt-2">
          @php
            // attempt to convert youtube url to embed src
            $embed = null;
            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([A-Za-z0-9_\-]+)/', $course->youtube_url, $m)) {
              $embed = 'https://www.youtube.com/embed/'.$m[1];
            }
          @endphp
          @if($embed)
            <iframe src="{{ $embed }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
          @else
            <a href="{{ $course->youtube_url }}" target="_blank" class="text-indigo-600">Open video</a>
          @endif
        </div>
      </div>
    @endif

    @if($course->zoom_url)
      <div class="mt-4">
        <h4 class="font-semibold">Zoom</h4>
        <div class="text-sm text-gray-700"><a href="{{ $course->zoom_url }}" target="_blank" class="text-indigo-600">Open Zoom link</a></div>
      </div>
    @endif

    @if($course->getMedia('attachments')->count())
      <div class="mt-4">
        <h4 class="font-semibold">Attachments</h4>
        <ul class="mt-2 space-y-2">
          @foreach($course->getMedia('attachments') as $att)
            <li><a href="{{ $att->getUrl() }}" class="text-indigo-600" target="_blank">{{ $att->file_name }}</a></li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="mt-6">
      @if(auth()->check())
        <form method="POST" action="{{ route('courses.enroll', $course->id) }}">
          @csrf
          <button class="px-4 py-2 bg-indigo-600 text-white rounded">Enroll</button>
        </form>
      @else
        @if($course->is_public)
          <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded">Enroll as guest</a>
        @else
          <div class="text-red-600 font-medium">Oops — you need to login to access this resource.</div>
          <a href="{{ route('login') }}" class="mt-3 inline-block text-indigo-600">Login</a>
        @endif
      @endif
    </div>

    {{-- list students (if trainer or admin) --}}
    @can('viewStudents', $course)
      <div class="mt-6">
        <h4 class="font-semibold">Enrolled students</h4>
        <ul class="mt-2">
          @foreach($course->enrollments as $enr)
            <li>
              @if($enr->user)
                {{ $enr->user->name }} ({{ $enr->user->email }})
              @else
                Guest — {{ $enr->guest_email }}
              @endif
              <span class="text-xs text-gray-500"> • {{ optional($enr->enrolled_at)->diffForHumans() }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    @endcan

  </div>
</div>
@endsection
