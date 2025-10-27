@extends('layouts.app')

@section('content')
<h1>Pending Trainers</h1>
@foreach($pending as $t)
  <div>
    <strong>{{ $t->name }}</strong> — {{ $t->email }}
    <form action="{{ route('admin.trainers.approve', $t) }}" method="POST" style="display:inline">
      @csrf
      <button type="submit">Approve</button>
    </form>
  </div>
@endforeach
{{ $pending->links() }}
@endsection
