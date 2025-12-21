@extends('dashboards.shell') {{-- or trainer's dashboard shell --}}
@section('dashboard-content')
  @include('trainer.courses.index-fragment')
@endsection
