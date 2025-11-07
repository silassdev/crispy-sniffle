<div x-data="{ open: false }" x-init="$watch('open', value => {} )">
  <button @click="open = true" class="px-3 py-1 border rounded text-sm">Logout</button>

  <!-- Modal -->
  <div x-show="open" x-cloak x-transition class="fixed inset-0 flex items-center justify-center z-50">
    <div class="fixed inset-0 bg-black/50" @click="open = false"></div>

    <div class="bg-white rounded shadow-lg max-w-md w-full p-5 z-50">
      <h3 class="text-lg font-semibold">Confirm logout</h3>
      <p class="text-sm text-gray-600 mt-2">Are you sure you want to log out?</p>

      <div class="mt-4 flex justify-end gap-2">
        <button @click="open = false" class="px-3 py-2 border rounded">Cancel</button>
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
</div><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views\livewire/actions/logout.blade.php ENDPATH**/ ?>