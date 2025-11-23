@extends('dashboards.shell')

@section('content')
  <livewire:admin.user-profile :user-id="$student->id" role="student" />
@endsection
