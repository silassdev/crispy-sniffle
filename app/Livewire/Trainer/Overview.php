<?php

namespace App\Livewire\Trainer;

use Livewire\Component;
use App\Services\TrainerDashboardService;

class Overview extends Component
{
    public array $analytics = [];

    protected ?TrainerDashboardService $service = null;

    // Livewire v3: container injection for mount()
    public function mount(TrainerDashboardService $service)
    {
        $this->service = $service;
        $this->analytics = $this->service->computeAnalytics();
    }

    // Support for lazy loading or polling
    public function loadAnalytics(): void
    {
        if ($this->service === null) {
            $this->service = app(TrainerDashboardService::class);
        }

        $this->analytics = $this->service->computeAnalytics();
    }

    public function render()
    {
        return view('livewire.trainer.overview');
    }
}
