<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashItem extends Component
{
    public $href;
    public $icon;
    public $label;
    public $component;

    /**
     * @param string $href  target url (optional)
     * @param string $icon  heroicon name (e.g. users, shield-check, academic-cap)
     * @param string $label visible text
     * @param string|null $component event payload for Livewire section switching
     */
    public function __construct($href = '#', $icon = 'view-grid', $label = '', $component = null)
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->label = $label;
        $this->component = $component;
    }

    public function render()
    {
        return view('components.dash-item');
    }
}
