<div x-data="{ open: false }">
    <!-- Trigger Button -->
    <button 
        @click="open = true" 
        class="icon-nav-item hover:bg-red-50 hover:text-red-600 transition-all duration-300 focus:outline-none"
        title="Logout"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
        <span class="icon-label">Logout</span>
    </button>

    <!-- Modal Backdrop -->
    <div 
        x-show="open" 
        x-cloak 
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <!-- Modal Card -->
        <div 
            @click.away="open = false"
            class="bg-white rounded-2xl shadow-2xl max-w-sm w-full p-8 text-center"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        >
            <div class="w-16 h-16 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h6a2 2 0 012 2v1" />
                </svg>
            </div>
            
            <h3 class="text-xl font-bold text-slate-900 mb-2">Confirm Logout</h3>
            <p class="text-slate-500 mb-8">Are you sure you want to end your session?</p>

            <div class="flex flex-col gap-3">
                <button
                    wire:click="logout"
                    class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-red-200"
                >
                    Log me out
                </button>
                <button 
                    @click="open = false" 
                    class="w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-colors"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/livewire/actions/logout.blade.php ENDPATH**/ ?>