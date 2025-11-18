@extends('layouts.app')

@section('content')
  <div class="p-6">
    <h1 class="text-xl font-semibold">Admins — Index</h1>
    <p>This is a placeholder. Replace with your admin listing UI.</p>

    @if(isset($admins) && $admins->count())
      <ul>
        @foreach($admins as $a)
          <li><a href="{{ route('admin.admins.show', $a->id) }}">{{ $a->name }} ({{ $a->email }})</a></li>
        @endforeach
      </ul>

      {{ $admins->links() }}
    @endif
  </div>
@endsection
