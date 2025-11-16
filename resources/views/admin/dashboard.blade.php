@extends('layouts.app')


@section('content')
<div class="flex">

 <livewire:sidebar :role="auth()->user()->role" />

 <livewire:admin.dashboard-shell />

 </div>

@endsection
