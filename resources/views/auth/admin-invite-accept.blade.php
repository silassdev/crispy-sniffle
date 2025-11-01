@extends('layouts.app')

@section('title','Accept Admin Invite')

@section('content')
  <x-toast />
<div class="max-w-md mx-auto">
  <form method="POST" action="{{ route('admin.invite.accept.submit') }}" x-data="{ loading:false }" @submit.prevent="loading=true; $el.submit();">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="mb-3">
      <label class="block text-sm font-medium">Email</label>
      <input name="email" value="{{ old('email', request('email')) }}" required class="mt-1 block w-full rounded-md border-gray-200"/>
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Password</label>
      <input name="password" type="password" required class="mt-1 block w-full rounded-md border-gray-200"/>
    </div>

    <div class="mb-3">
      <label class="block text-sm font-medium">Confirm Password</label>
      <input name="password_confirmation" type="password" required class="mt-1 block w-full rounded-md border-gray-200"/>
    </div>

    <button class="px-4 py-2 bg-indigo-600 text-white rounded-md" :disabled="loading">
      <span x-show="!loading">Set password</span>
      <span x-show="loading">@include('components.donut-loader') Creating...</span>
    </button>
  </form>
</div>
@endsection
