@extends('layouts.app')

@section('title', $post->title)

{{-- SEO meta: readable title & description + Open Graph --}}
@section('meta')
  <meta name="description" content="{{ e($post->excerpt ?: Str::limit(strip_tags($post->body), 160)) }}">
  <meta property="og:title" content="{{ e($post->title) }}">
  <meta property="og:description" content="{{ e($post->excerpt ?: Str::limit(strip_tags($post->body), 160)) }}">
  @php
    $ogImage = null;
    if (method_exists($post, 'getFirstMedia')) {
        try {
            $m = $post->getFirstMedia('feature_images');
            $ogImage = $m ? ($m->getUrl('thumb') ?? $m->getUrl()) : null;
        } catch (\Throwable $e) { $ogImage = null; }
    } else {
        $ogImage = $post->feature_image ? asset('storage/'.$post->feature_image) : null;
    }
  @endphp
  @if($ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
    <meta name="twitter:card" content="summary_large_image">
  @endif

  <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
      <livewire:post-show :slug="$post->slug" />
    </div>
  </div>
@endsection
