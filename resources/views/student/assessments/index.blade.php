@extends('dashboards.shell') {{-- or student dashboard layout --}}
@section('content')
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-xl font-semibold mb-4">Pending Assessments</h1>

    {{-- Mount Livewire in full mode: showAll=true, perPage optional --}}
    <livewire:student.pending-assessments :show-all="true" :per-page="10" />
  </div>
@endsection
