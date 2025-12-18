@extends('layouts.app')

@section('title', 'Blogs')

@section('content')
  <div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Blog</h1>
      <form method="GET" action="{{ route('blogs.index') }}" class="flex items-center gap-2">
        <input name="q" value="{{ request('q') }}" placeholder="Search posts..." class="border rounded px-3 py-2 text-sm" />
        <button class="px-3 py-2 bg-indigo-600 text-white rounded text-sm">Search</button>
      </form>
    </div>

    <div>
      <livewire:community.community-feed post-type="blog" />
    </div>
  </div>
@endsection
