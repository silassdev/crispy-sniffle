@extends('layouts.app')

@section('title', $job->title)

@section('meta')
  <meta name="description" content="{{ e($job->excerpt ?: Str::limit(strip_tags($job->description), 160)) }}">
  <link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex items-start gap-4">
      @php $logo = $job->getFirstMedia('company_logos'); @endphp
      <div>
        @if($logo)
          <img src="{{ $logo->getUrl('logo_small') }}" class="w-24 h-24 object-cover rounded" alt="{{ $job->company_name }}">
        @else
          <div class="w-24 h-24 bg-gray-100 rounded flex items-center justify-center text-xl">{{ strtoupper(substr($job->company_name ?: 'J',0,1)) }}</div>
        @endif
      </div>
      <div class="flex-1">
        <h1 class="text-2xl font-bold">{{ $job->title }}</h1>
        <div class="text-sm text-gray-600">{{ $job->company_name }} • {{ $job->location }} • {{ $job->employment_type }}</div>
      </div>
      <div class="text-right">
        @if($job->is_active)
          <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded">Hiring</span>
        @else
          <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">Closed</span>
        @endif
      </div>
    </div>

    <div class="mt-6 prose max-w-none">
      {!! $job->description !!}
    </div>

    @if($job->tech_stack && is_array($job->tech_stack) && count($job->tech_stack))
      <div class="mt-6">
        <h4 class="font-semibold">Tech stack</h4>
        <div class="flex flex-wrap gap-2 mt-2">
          @foreach($job->tech_stack as $t)
            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $t }}</span>
          @endforeach
        </div>
      </div>
    @endif

    <div class="mt-6">
      <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded">Apply on company site</a>
    </div>
  </div>
</div>
@endsection
