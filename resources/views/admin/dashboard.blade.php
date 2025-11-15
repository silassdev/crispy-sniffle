@extends('layouts.dashboard')

@section('title','Admin Dashboard')
@section('page-title','welcome admin')

@section('content')

 <livewire:sidebar :role="session('view_as') ?? (auth()->user()->role ?? 'student')" />

@endsection
