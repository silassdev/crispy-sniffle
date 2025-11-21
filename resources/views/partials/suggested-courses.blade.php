@php
  $courses = $courses ?? \App\Models\Course::latest()->take(6)->get();
@endphp

<div class="space-y-3 text-sm">
  @forelse($courses as $c)
    <a href="{{ url('/courses/' . ($c->slug ?? $c->id)) }}" class="block p-2 rounded hover:bg-gray-50 transition">
      <div class="font-medium">{{ $c->title }}</div>
      <div class="text-xs text-gray-500">{{ Str::limit($c->description ?? '', 60) }}</div>
    </a>
  @empty
    <div class="text-gray-500">No courses available yet.</div>
  @endforelse
</div>
