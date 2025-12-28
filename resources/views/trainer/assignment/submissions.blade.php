@extends('dashboards.shell')
@section('content')
  <livewire:trainer.submission-manager :assessment-id="$assessmentId" />
@endsection
