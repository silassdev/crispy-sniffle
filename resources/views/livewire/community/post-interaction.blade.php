<div class="flex items-center gap-2 flex-wrap">
    @php
        $reactions = [
            'like' => ['icon' => '👍', 'color' => 'from-blue-500 to-blue-600', 'label' => 'Like'],
            'love' => ['icon' => '❤️', 'color' => 'from-pink-500 to-red-500', 'label' => 'Love'],
            'celebrate' => ['icon' => '🎉', 'color' => 'from-yellow-500 to-orange-500', 'label' => 'Celebrate'],
            'insightful' => ['icon' => '💡', 'color' => 'from-purple-500 to-indigo-500', 'label' => 'Insightful'],
            'curious' => ['icon' => '🤔', 'color' => 'from-green-500 to-teal-500', 'label' => 'Curious'],
        ];
    @endphp

    @foreach($reactions as $type => $data)
        <button 
            wire:click="toggleReaction('{{ $type }}')"
            class="group relative inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full transition-all duration-300 
                   {{ $userReaction === $type 
                      ? 'bg-gradient-to-r ' . $data['color'] . ' text-white shadow-lg scale-105' 
                      : 'bg-gray-100 hover:bg-gray-200 text-gray-600 hover:scale-105' }}"
            title="{{ $data['label'] }}"
        >
            <span class="text-base transition-transform group-hover:scale-125">{{ $data['icon'] }}</span>
            @if(isset($reactionCounts[$type]) && $reactionCounts[$type] > 0)
                <span class="text-xs font-bold">{{ $reactionCounts[$type] }}</span>
            @endif
            
            {{-- Tooltip --}}
            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">
                {{ $data['label'] }}
            </span>
        </button>
    @endforeach

    {{-- Total reaction count --}}
    @php
        $totalReactions = array_sum($reactionCounts);
    @endphp
    
    @if($totalReactions > 0)
        <span class="text-xs text-gray-500 font-medium ml-1">
            {{ $totalReactions }} {{ Str::plural('reaction', $totalReactions) }}
        </span>
    @endif
</div>
