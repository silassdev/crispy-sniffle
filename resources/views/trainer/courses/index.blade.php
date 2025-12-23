@extends('dashboards.shell')
@section('dashboard-content')
  @include('trainer.courses.index-fragment')
  <livewire:trainer.course-manager />
@endsection
