@php
    // If a controller passed $posts use it, otherwise fetch the latest posts
    $posts = $posts ?? \App\Models\Post::latest()->take(10)->get();
@endphp

{{-- delegate to the feed partial (create partials/feed.blade.php if missing) --}}
@include('partials.feed', ['posts' => $posts])
