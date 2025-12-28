@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')
@section('dashboard-content')
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Assessments</h1>
    <p class="text-slate-500">View upcoming and past assessments.</p>
  </div>

  {{-- Mount Livewire in full mode: showAll=true, perPage optional --}}
  <livewire:student.pending-assessments :show-all="true" :per-page="10" />
@endsection
