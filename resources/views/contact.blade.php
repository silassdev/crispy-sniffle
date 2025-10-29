@extends('layouts.app')
@section('title','Contact')
@section('content')
  <h1 class="text-2xl mb-4">Contact</h1>

  <form method="POST" action="{{ route('contact.submit') }}">
    @csrf
    <div class="mb-3">
      <label>Name</label>
      <input name="name" value="{{ old('name') }}" class="w-full border p-2" />
      @error('name')<div class="text-red-600">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input name="email" value="{{ old('email') }}" class="w-full border p-2" />
      @error('email')<div class="text-red-600">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label>Message</label>
      <textarea name="message" class="w-full border p-2">{{ old('message') }}</textarea>
      @error('message')<div class="text-red-600">{{ $message }}</div>@enderror
    </div>
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Send</button>
  </form>
@endsection
