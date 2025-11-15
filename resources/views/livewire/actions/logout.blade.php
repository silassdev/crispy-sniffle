<div x-data="{ open: false }">
    <!-- Trigger -->
    <button 
        @click="open = true" 
        class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 text-sm"
    >
        <!-- Icon -->
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h6a2 2 0 012 2v1" />
        </svg>

        <!-- Label (optional, collapsible) -->
        <span 
            x-show="document.body.dataset.sidebarOpen === 'true'"
            x-transition
        >
            Logout
        </span>
    </button>

    <!-- Modal -->
    <div 
        x-show="open" 
        x-cloak 
        x-transition.opacity 
        class="fixed inset-0 z-50 flex items-center justify-center"
    >
        <!-- Background overlay -->
        <div 
            class="absolute inset-0 bg-black/50"
            @click="open = false"
        ></div>

        <!-- Modal card -->
        <div 
            x-transition.scale 
            class="relative bg-white rounded-lg shadow-lg max-w-md w-full p-6"
        >
            <h3 class="text-lg font-semibold">Confirm logout</h3>
            <p class="text-sm text-gray-600 mt-2">
                Are you sure you want to log out?
            </p>

            <div class="mt-5 flex justify-end gap-2">
                <button 
                    @click="open = false" 
                    class="px-3 py-2 border rounded"
                >
                    Cancel
                </button>

                <button
                    wire:click="logout"
                    @click="open = false"
                    class="px-3 py-2 bg-red-600 text-white rounded"
                >
                    Yes, logout
                </button>
            </div>
        </div>
    </div>
</div>
