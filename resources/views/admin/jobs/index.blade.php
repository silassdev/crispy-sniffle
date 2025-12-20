@extends('dashboards.shell', ['section' => 'jobs', 'role' => 'admin'])

@section('content')
  @include('admin.jobs.index-fragment')
@endsection

@push('scripts')
  <script src="{{ asset('js/notifications.js') }}"></script>
@endpush

