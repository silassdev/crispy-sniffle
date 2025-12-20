<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Services\StudentDashboardService;

class Overview extends Component
{
    public array $analytics = [];

    protected ?StudentDashboardService $service = null;

    // Livewire v3: container injection for mount()
    public function mount(StudentDashboardService $service)
    {
        $this->service = $service;
        $this->analytics = $this->service->computeAnalytics();
    }

    // Support for lazy loading or polling
    public function loadAnalytics(): void
    {
        if ($this->service === null) {
            $this->service = app(StudentDashboardService::class);
        }

        $this->analytics = $this->service->computeAnalytics();
    }

    public function render()
    {
        return view('livewire.student.overview');
    }
}
