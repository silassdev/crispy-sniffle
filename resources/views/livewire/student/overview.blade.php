<div class="p-4">
  <div wire:loading wire:target="loadAnalytics" class="space-y-4">
    <div class="animate-pulse grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
      @for ($i = 0; $i < 5; $i++)
        <div class="h-28 rounded-md bg-slate-200 dark:bg-slate-800 p-4">
          <div class="h-4 bg-slate-300 dark:bg-slate-700 rounded w-1/3 mb-3"></div>
          <div class="h-8 bg-slate-300 dark:bg-slate-700 rounded w-1/2"></div>
        </div>
      @endfor
    </div>
  </div>

  <div wire:loading.remove wire:target="loadAnalytics">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
      <div>
        <h2 class="text-1xl sm:text-1xl font-bold leading-tight text-gray-600 dark:text-green">Student Overview</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Your learning progress and achievements.</p>
      </div>
    </div>

    {{-- Key Metrics Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
      @php
        $metrics = [
          ['label'=>'Enrolled Courses','key'=>'enrolled_courses','icon'=>'📚','color'=>'bg-sky-50 text-sky-600 dark:bg-sky-900/20'],
          ['label'=>'Completed','key'=>'completed_courses','icon'=>'✅','color'=>'bg-green-50 text-green-600 dark:bg-green-900/20'],
          ['label'=>'Pending Tasks','key'=>'pending_assignments','icon'=>'📝','color'=>'bg-amber-50 text-amber-600 dark:bg-amber-900/20'],
          ['label'=>'Average Score','key'=>'average_score','icon'=>'⭐','color'=>'bg-purple-50 text-purple-600 dark:bg-purple-900/20', 'suffix' => '%'],
          ['label'=>'Study Streak','key'=>'study_streak_days','icon'=>'🔥','color'=>'bg-orange-50 text-orange-600 dark:bg-orange-900/20', 'suffix' => ' days'],
        ];
      @endphp

      @foreach($metrics as $metric)
      <div class="relative rounded-md p-4 {{ $metric['color'] }} border border-slate-200 dark:border-slate-700 shadow-sm">
        <div class="flex items-start justify-between gap-3">
          <div class="flex-1 min-w-0">
            <div class="text-sm opacity-75 truncate mb-1">{{ $metric['label'] }}</div>
            <div class="text-2xl font-bold">
              {{ $analytics[$metric['key']] ?? 0 }}{{ $metric['suffix'] ?? '' }}
            </div>
          </div>
          <div class="text-3xl opacity-50">{{ $metric['icon'] }}</div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Course Progress --}}
    @if(!empty($analytics['courses_progress']))
    <div class="mb-8">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Course Progress</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($analytics['courses_progress'] as $course)
        <div class="bg-white dark:bg-slate-800 rounded-lg p-4 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-start justify-between mb-3">
            <h4 class="font-semibold text-gray-800 dark:text-gray-200">{{ $course['name'] }}</h4>
            @if($course['grade'])
              <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-medium rounded">
                {{ $course['grade'] }}%
              </span>
            @endif
          </div>
          <div>
            <div class="flex justify-between text-sm mb-1">
              <span class="text-slate-600 dark:text-slate-400">Progress:</span>
              <span class="font-medium">{{ $course['progress'] }}%</span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
              <div class="bg-sky-600 h-2 rounded-full transition-all" style="width: {{ $course['progress'] }}%"></div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      {{-- Upcoming Deadlines --}}
      @if(!empty($analytics['upcoming_deadlines']))
      <div>
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Upcoming Deadlines</h3>
        <div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
          <div class="divide-y divide-slate-200 dark:divide-slate-700">
            @foreach($analytics['upcoming_deadlines'] as $deadline)
            <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <h5 class="font-medium text-gray-800 dark:text-gray-200">{{ $deadline['assignment'] }}</h5>
                  <p class="text-sm text-slate-600 dark:text-slate-400">{{ $deadline['course'] }}</p>
                </div>
                <div class="text-right">
                  <div class="text-sm font-medium {{ $deadline['days_left'] <= 2 ? 'text-red-600 dark:text-red-400' : 'text-amber-600 dark:text-amber-400' }}">
                    {{ $deadline['days_left'] }} days left
                  </div>
                  <div class="text-xs text-slate-500 dark:text-slate-400">{{ $deadline['due_date'] }}</div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif

      {{-- Recent Grades --}}
      @if(!empty($analytics['recent_grades']))
      <div>
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Recent Grades</h3>
        <div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
          <div class="divide-y divide-slate-200 dark:divide-slate-700">
            @foreach($analytics['recent_grades'] as $grade)
            <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <h5 class="font-medium text-gray-800 dark:text-gray-200">{{ $grade['assignment'] }}</h5>
                  <p class="text-sm text-slate-600 dark:text-slate-400">{{ $grade['course'] }}</p>
                </div>
                <div class="text-right">
                  <div class="text-lg font-bold {{ $grade['grade'] >= 90 ? 'text-green-600 dark:text-green-400' : ($grade['grade'] >= 70 ? 'text-sky-600 dark:text-sky-400' : 'text-amber-600 dark:text-amber-400') }}">
                    {{ $grade['grade'] }}%
                  </div>
                  <div class="text-xs text-slate-500 dark:text-slate-400">{{ $grade['date'] }}</div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
