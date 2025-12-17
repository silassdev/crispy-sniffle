@extends('layouts.app')
@section('content')
  <article class="prose lg:prose-xl mx-auto">
    <h1>{{ $post->title }}</h1>
    <p class="text-sm text-gray-500">By {{ $post->author->name }} • {{ $post->published_at->toDayDateTimeString() }}</p>
    @if($post->feature_image)
      <img src="{{ asset('storage/'.$post->feature_image) }}" alt="" class="w-full rounded my-4">
    @endif
    <div class="mt-4">{!! $post->body !!}</div>
  </article>

  <div class="mt-10">
    <livewire:comments.thread :post="$post" />
  </div>
@endsection
