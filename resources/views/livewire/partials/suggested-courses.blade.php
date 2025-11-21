@php
    $courses = $courses ?? \App\Models\Course::latest()->take(6)->get();
@endphp

<div class="p-4 border rounded">
  <h4 class="font-semibold mb-3">Suggested courses</h4>

  @forelse($courses as $c)
    <div class="mb-3">
      <a href="{{ url('/courses/' . ($c->slug ?? $c->id)) }}" class="text-sm font-medium">{{ $c->title ?? 'Course' }}</a>
      <div class="text-xs text-gray-500">{{ Str::limit($c->description ?? '', 80) }}</div>
    </div>
  @empty
    <div class="text-sm text-gray-500">No courses available.</div>
  @endforelse
</div>
