@extends('layouts.guest')

@section('title', 'Reset password')

@section('content')
  <div class="py-12">
    <livewire:auth.reset-password :token="$token" />
  </div>
@endsection
