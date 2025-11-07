@extends('layouts.guest')

@section('title','Complete admin setup')

@section('content')
  <div class="py-12">
    <livewire:admin.invite-accept :token="$token" />
  </div>
@endsection
