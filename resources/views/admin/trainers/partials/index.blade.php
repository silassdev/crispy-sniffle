<div class="p-4">
  <h2 class="text-2xl font-semibold mb-4">Trainers</h2>

  @if($trainers->count())
    @foreach($trainers as $t)
      <div class="p-2 border rounded mb-2">
        <div class="font-medium">{{ $t->name }}</div>
        <div class="text-xs text-gray-500">{{ $t->email }}</div>
      </div>
    @endforeach

    <div class="mt-4">
      {{ $trainers->links() }}
    </div>
  @else
    <p class="text-sm text-gray-500">No trainers found.</p>
  @endif
</div>
