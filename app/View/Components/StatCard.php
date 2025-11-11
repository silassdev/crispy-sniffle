<?php
namespace App\View\Components;
use Illuminate\View\Component;
class StatCard extends Component
{
    public $title; public $value; public $color;
    public function __construct($title,$value,$color='indigo'){ $this->title=$title;$this->value=$value;$this->color=$color; }
    public function render(){ return view('components.stat-card'); }
}
