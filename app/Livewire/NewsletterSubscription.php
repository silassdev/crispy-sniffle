<?php

namespace App\Livewire;

use Livewire\Component;

class NewsletterSubscription extends Component
{
    public $email = '';
    public $showModal = false;
    public $interests = [];
    
    public $availableInterests = [
        'web_dev' => 'Web Development',
        'app_dev' => 'App Development',
        'devops' => 'DevOps & Cloud',
        'ai_ml' => 'AI & Machine Learning',
        'cybersec' => 'Cybersecurity',
        'data_sci' => 'Data Science',
        'ui_ux' => 'UI/UX Design',
        'game_dev' => 'Game Development',
    ];

    protected $rules = [
        'email' => 'required|email',
    ];

    public function openModal()
    {
        $this->validate();
        $this->showModal = true;
    }

    public function toggleInterest($key)
    {
        if (in_array($key, $this->interests)) {
            $this->interests = array_diff($this->interests, [$key]);
        } else {
            if (count($this->interests) < 5) {
                $this->interests[] = $key;
            }
        }
    }

    public function subscribe()
    {
        $this->validate();

        // Check if interests are selected (optional validation, user said "Then we can add Intrest... before form is submited")
        // Just simulating submission for now.
        
        // Log or save logic here...
        // \Log::info('Newsletter subscription', ['email' => $this->email, 'interests' => $this->interests]);

        session()->flash('success', 'Thank you for subscribing! We have customized your preferences.');
        
        $this->reset(['email', 'showModal', 'interests']);
        
        // Dispatch event for toast
        $this->dispatch('toast', [
            'type' => 'success', 
            'title' => 'Subscribed!', 
            'message' => 'You have successfully joined our newsletter.'
        ]);
    }

    public function render()
    {
        return view('livewire.newsletter-subscription');
    }
}
