<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\DashboardService;

class Overview extends Component
{
    public array $counters = [
        'students' => 0,
        'trainers' => 0,
        'admins'   => 0,
        'posts'    => 0,
        'invites'  => 0,
    ];

    protected DashboardService $service;

    // Livewire v3 supports this (auto DI)
    public function boot(DashboardService $service)
    {
        $this->service = $service;
    }

    public function loadCounters(): void
    {
        $this->counters = $this->service->computeCounters();
    }

    public function render()
    {
        return view('livewire.admin.overview');
    }
}
