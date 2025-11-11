<?php
namespace App\View\Components;
use Illuminate\View\Component;

class DashItem extends Component
{
    public $href;
    public $icon;
    public $label;
    public $component;
    public function __construct($href='#', $icon='view-grid', $label='', $component=null)
    {
        $this->href = $href; $this->icon = $icon; $this->label = $label; $this->component = $component;
    }
    public function render(){ return view('components.dash-item'); }
}
