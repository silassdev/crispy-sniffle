@extends('layouts.guest')

@section('title','Login')

@section('content')
  <livewire:forms.login-form :role="request()->query('role','student')" />
@endsection