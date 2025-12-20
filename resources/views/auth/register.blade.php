@extends('layouts.guest')

@section('title','Register')

@section('content')
  <livewire:forms.register-form :role="request()->query('role','student')" />
@endsection
