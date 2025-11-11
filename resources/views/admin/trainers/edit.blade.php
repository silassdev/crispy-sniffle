@extends('layouts.dashboard')
@section('title','Edit trainer')
@section('page-title','Trainer profile')
@section('content')
  <livewire:admin.trainer-profile :id="$id" />
@endsection
