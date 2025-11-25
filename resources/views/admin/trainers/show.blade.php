@extends('dashboards.shell')

@section('content')
  <livewire:admin.user-profile :user="$user" :role="$role" />
@endsection
