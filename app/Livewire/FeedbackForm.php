<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedback;

class FeedbackForm extends Component
{
    public $name = '';
    public $email = '';
    public $country = '';
    public $type = 'General Comments';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'country' => 'required|min:2',
        'type' => 'required',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        Feedback::create([
            'name' => $this->name,
            'email' => $this->email,
            'country' => $this->country,
            'type' => $this->type,
            'message' => $this->message,
            'ip' => request()->ip(),
        ]);

        $this->reset(['name', 'email', 'country', 'type', 'message']);
        
        session()->flash('message', 'Thank you for your feedback! We appreciate your input.');
    }

    public function render()
    {
        return view('livewire.feedback-form');
    }
}
