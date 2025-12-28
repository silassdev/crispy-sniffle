@extends('layouts.app')
@section('title', $course->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <div class="grid lg:grid-cols-3 gap-8">
    {{-- Main Content --}}
    <div class="lg:col-span-2">
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        @php $img = $course->getFirstMediaUrl('illustration','thumb'); @endphp
        @if($img)
          <img src="{{ $img }}" class="w-full h-64 object-cover" alt="{{ $course->title }}">
        @endif

        <div class="p-8">
          <div class="flex items-center gap-3 mb-4">
            @if($course->is_public)
              <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">FREE</span>
            @else
              <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                PREMIUM
              </span>
            @endif
          </div>

          <h1 class="text-3xl font-bold text-slate-900 mb-2">{{ $course->title }}</h1>
          
          @if($course->trainer)
            <div class="flex items-center gap-2 text-sm text-slate-600 mb-6">
              <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                {{ substr($course->trainer->name, 0, 1) }}
              </div>
              <span>by <strong>{{ $course->trainer->name }}</strong></span>
            </div>
          @endif

          @if($course->description)
            <p class="text-slate-600 italic mb-4">{{ $course->description }}</p>
          @endif

          @if($course->body)
            <div class="prose prose-slate max-w-none mb-6">
              {!! \Parsedown::instance()->text($course->body) !!}
            </div>
          @endif

          @if($course->tags && count($course->tags) > 0)
            <div class="flex flex-wrap gap-2 mb-6">
              @foreach($course->tags as $tag)
                <span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full">{{ $tag }}</span>
              @endforeach
            </div>
          @endif

          {{-- Enrollment CTA --}}
          @if(!$isEnrolled && auth()->check() && auth()->user()->role === 'student')
            <form method="POST" action="{{ route('courses.enroll', $course->id) }}" class="mt-6">
              @csrf
              <button class="w-full px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-colors">
                Enroll in this Course
              </button>
            </form>
          @elseif(!auth()->check())
            <div class="mt-6 p-4 bg-indigo-50 border border-indigo-200 rounded-lg">
              <p class="text-indigo-900 font-semibold mb-2">Ready to start learning?</p>
              <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700">
                Log in to Enroll
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>

    {{-- Sidebar --}}
    <div class="lg:col-span-1">
      {{-- Course Stats --}}
      <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
        <h3 class="font-bold text-slate-900 mb-4">Course Info</h3>
        <div class="space-y-3 text-sm">
          <div class="flex justify-between">
            <span class="text-slate-600">Students</span>
            <span class="font-semibold">{{ $course->students()->count() }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-slate-600">Chapters</span>
            <span class="font-semibold">{{ $course->chapters()->count() }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-slate-600">Status</span>
            <span class="font-semibold {{ $course->is_public ? 'text-emerald-600' : 'text-amber-600' }}">
              {{ $course->is_public ? 'Public' : 'Premium' }}
            </span>
          </div>
        </div>

        {{-- External Links --}}
        @if($course->zoom_url || $course->youtube_url)
          <div class="mt-6 pt-6 border-t border-slate-100 space-y-2">
            @if($course->zoom_url)
              <a href="{{ $course->zoom_url }}" target="_blank" class="flex items-center gap-2 text-sm text-blue-600 hover:underline">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 13.464a.992.992 0 01-.993.992H7.1a.992.992 0 01-.993-.992V10.54c0-.55.445-.993.993-.993h9.801c.548 0 .993.443.993.993v2.924z"/></svg>
                Join Zoom Meeting
              </a>
            @endif
            @if($course->youtube_url)
              <a href="{{ $course->youtube_url }}" target="_blank" class="flex items-center gap-2 text-sm text-red-600 hover:underline">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                Watch Preview
              </a>
            @endif
          </div>
        @endif
      </div>

      {{-- Chapters List (only for enrolled students or trainers/admins) --}}
      @if($chapters->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
          <h3 class="font-bold text-slate-900 mb-4">Course Curriculum</h3>
          <div class="space-y-2">
            @foreach($chapters as $chapter)
              <div class="flex items-center gap-3 p-3 rounded-lg {{ $chapter->isCompleted ?? false ? 'bg-emerald-50' : ($chapter->isUnlocked ?? false ? 'bg-white hover:bg-slate-50' : 'bg-slate-50') }} border {{ $chapter->isCompleted ?? false ? 'border-emerald-200' : 'border-slate-200' }} transition-colors">
                <div class="flex-shrink-0">
                  @if($chapter->isCompleted ?? false)
                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                  @elseif($chapter->isUnlocked ?? false)
                    <div class="w-5 h-5 rounded-full border-2 border-indigo-600"></div>
                  @else
                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                  @endif
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-sm font-medium {{ ($chapter->isUnlocked ?? false) ? 'text-slate-900' : 'text-slate-400' }} truncate">
                    {{ $chapter->order }}. {{ $chapter->title }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
