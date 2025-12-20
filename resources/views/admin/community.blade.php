{{-- resources/views/admin/community.blade.php --}}
@extends('dashboards.shell', ['section' => 'community', 'role' => 'admin'])

@section('content')
  @include('admin.community-fragment')
@endsection

