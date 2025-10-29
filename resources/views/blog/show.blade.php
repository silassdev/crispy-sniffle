@extends('layouts.app')
@section('title',$post->title)
@section('content')
  <article>
    <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
    <div class="text-sm text-gray-500 mb-4">By {{ optional($post->user)->name ?? 'Admin' }} — {{ $post->published_at?->format('M d, Y') }}</div>
    <div class="prose max-w-none">{!! $post->body !!}</div>
  </article>
@endsection
