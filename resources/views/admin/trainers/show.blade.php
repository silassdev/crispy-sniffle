@extends('dashboards.shell')

@section('content')
  <livewire:admin.user-profile :user-id="$admin->id" role="admin" />
@endsection
