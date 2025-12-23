@extends('dashboards.shell')
@section('content')
  <livewire:trainer.assessment-manager :course-id="$courseId" />
@endsection
