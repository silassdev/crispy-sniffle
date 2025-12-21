@extends('layouts.app')
@section('title','Courses')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-2xl font-semibold mb-4">Courses</h1>
  <div class="grid md:grid-cols-3 gap-6">
    @foreach($courses as $c)
      @php $img = $c->getFirstMediaUrl('illustration','thumb') ?: null; @endphp
      <article class="bg-white rounded shadow p-4">
        @if($img)
          <img src="{{ $img }}" alt="{{ $c->title }}" class="w-full h-40 object-cover rounded mb-3">
        @endif
        <h3 class="font-semibold text-lg"><a href="{{ route('courses.show',$c->slug) }}" class="hover:underline">{{ $c->title }}</a></h3>
        <div class="text-sm text-gray-500">{{ $c->excerpt }}</div>
        <div class="mt-3 flex items-center justify-between">
          <div class="text-xs text-gray-500">{{ $c->trainer->name ?? 'Unknown' }}</div>
          <a href="{{ route('courses.show',$c->slug) }}" class="text-sm text-indigo-600">View</a>
        </div>
      </article>
    @endforeach
  </div>

  <div class="mt-6">{{ $courses->links() }}</div>
</div>
@endsection
