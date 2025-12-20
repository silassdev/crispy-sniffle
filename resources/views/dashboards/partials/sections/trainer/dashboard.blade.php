
<div class="p-6 max-w-7xl mx-auto">
  <h1 class="text-2xl font-bold mb-4">Trainer Dashboard</h1>
  <p class="text-gray-700 mb-6">Welcome, {{ auth()->user()->name }}. This is your trainer area.</p>

  <livewire:trainer.overview />
</div>
