@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto p-6">
    {{-- small hero for logged in users --}}
    <div class="mb-6">
      <h1 class="text-2xl font-semibold">Welcome back, {{ $user->name }}</h1>
      <p class="text-sm text-gray-500">Explore courses, posts and the community.</p>
    </div>

    {{-- feed / posts --}}
    <div class="grid md:grid-cols-3 gap-6">
      <div class="md:col-span-2">
        @include('partials.feed', ['posts' => $posts ?? null]) 
      </div>
      <aside>
        @include('partials.suggested-courses')
      </aside>
    </div>
  </div>
@endsection
