@extends(request()->ajax() ? 'layouts.plain' : 'dashboards.shell')

@section('dashboard-content')
    <livewire:trainer.certificates-index />
@endsection