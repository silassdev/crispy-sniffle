@extends('layouts.app')

@section('title','Careers')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-6">Careers</h1>

  <div class="grid md:grid-cols-2 gap-6">
    @forelse($jobs as $job)
      @php $logo = $job->getFirstMedia('company_logos'); @endphp
      <article class="bg-white rounded shadow p-4 flex gap-4">
        <div class="w-24 h-24 flex-shrink-0">
          @if($logo)
            <img src="{{ $logo->getUrl('logo_small') }}" alt="{{ $job->company_name }}" class="w-24 h-24 object-cover rounded">
          @else
            <div class="w-24 h-24 bg-gray-100 rounded flex items-center justify-center">{{ strtoupper(substr($job->company_name ?: 'J',0,1)) }}</div>
          @endif
        </div>

        <div class="flex-1">
          <a href="{{ route('careers.show',$job->slug) }}" class="text-lg font-semibold hover:underline">{{ $job->title }}</a>
          <div class="text-sm text-gray-500">{{ $job->company_name }} • {{ $job->location }} • {{ $job->employment_type }}</div>
          <p class="mt-2 text-gray-700">{{ $job->excerpt }}</p>
          <div class="mt-3 flex items-center justify-between">
            <div class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</div>
            <div>
              @if($job->is_active)
                <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded">Hiring</span>
              @else
                <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">Closed</span>
              @endif
            </div>
          </div>
        </div>
      </article>
    @empty
      <div class="text-center text-gray-500">No job listings yet.</div>
    @endforelse
  </div>

  <div class="mt-6">
    {{ $jobs->links() }}
  </div>
</div>
@endsection
