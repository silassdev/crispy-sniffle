<div class="p-4">
  <div wire:loading wire:target="loadCounters" class="space-y-4">
    <div class="animate-pulse grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
      @for ($i = 0; $i < 5; $i++)
        <div class="h-28 rounded-md bg-slate-200 dark:bg-slate-800 p-4">
          <div class="h-4 bg-slate-300 dark:bg-slate-700 rounded w-1/3 mb-3"></div>
          <div class="h-8 bg-slate-300 dark:bg-slate-700 rounded w-1/2"></div>
        </div>
      @endfor
    </div>
  </div>

  <div wire:loading.remove wire:target="loadCounters">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
      <div>
        <h2 class="text-1xl sm:text-1xl font-bold leading-tight text-gray-600 dark:text-green">Overview</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Key metrics for your application.</p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
      @php
        $cards = [
          ['label'=>'Students','key'=>'students','trend'=>'+3.4%','trendColor'=>'text-green-600','trendNote'=>'since last week'],
          ['label'=>'Trainers','key'=>'trainers','trend'=>'—','trendColor'=>'text-slate-500','trendNote'=>'this month'],
          ['label'=>'Admins','key'=>'admins','trend'=>'+1','trendColor'=>'text-indigo-600','trendNote'=>'new'],
          ['label'=>'Posts','key'=>'posts','trend'=>'—','trendColor'=>'text-slate-500','trendNote'=>'this quarter'],
          ['label'=>'Invites','key'=>'invites','trend'=>'—','trendColor'=>'text-slate-500','trendNote'=>'pending'],
        ];
      @endphp

      @foreach($cards as $card)
      <div class="relative rounded-md p-4 bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 shadow-sm">
        <div class="flex items-start justify-between gap-3">
          <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 rounded-md bg-slate-300 dark:bg-slate-700 flex items-center justify-center">
              <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14c4 0 6 2 6 4v1H6v-1c0-2 2-4 6-4z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 10a3 3 0 100-6 3 3 0 000 6z"/>
              </svg>
            </div>

            <div class="min-w-0">
              <div class="text-sm text-slate-600 dark:text-slate-400 truncate">{{ $card['label'] }}</div>
              <div class="text-xl font-bold text-slate-900 dark:text-white">{{ $counters[$card['key']] ?? 0 }}</div>
            </div>
          </div>

          <div class="flex flex-col items-end">
            <div class="text-xs font-semibold {{ $card['trendColor'] }}">{{ $card['trend'] }}</div>
            <div class="text-xs text-slate-500 dark:text-slate-400">{{ $card['trendNote'] }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
