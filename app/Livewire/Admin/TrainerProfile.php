<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Validation\Rule;

class TrainerProfile extends Component
{
    use WithFileUploads;

    public $trainerId;
    public $trainer;

    // editable
    public $name;
    public $email;
    public $phone;
    public $bio;
    public $skills;
    public $social_links = [];

    // readonly
    public $joined_at;
    public $total_courses = 0;
    public $achievements = [];

    public $avatar;

    protected $rules = [
        'name' => 'required|string|max:150',
        'email' => ['required','email','max:255',],
        'phone' => 'nullable|string|max:40',
        'bio' => 'nullable|string|max:2000',
        'skills' => 'nullable|string|max:1000',
        'avatar' => 'nullable|image|max:2048',
    ];

    public function mount($id)
    {
        $this->trainerId = $id;
        $this->loadTrainer();
    }

    protected function loadTrainer()
    {
        $this->trainer = User::findOrFail($this->trainerId);

        $this->name = $this->trainer->name;
        $this->email = $this->trainer->email;
        $this->phone = $this->trainer->phone ?? null;
        $this->bio = $this->trainer->bio ?? null;
        $this->skills = $this->trainer->skills ?? null;
        $this->social_links = $this->trainer->social_links ?? [];
        $this->joined_at = $this->trainer->created_at?->toDayDateTimeString();
        // total_courses and achievements are assumed relations or computed fields
        $this->total_courses = $this->trainer->courses()->count() ?? 0;
        $this->achievements = $this->trainer->achievements ?? [];
    }

    public function save()
    {
        $this->validate();

        // unique email check ignoring this trainer
        $this->validate(['email' => ['required','email', Rule::unique('users','email')->ignore($this->trainer->id)]]);

        $this->trainer->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'skills' => $this->skills,
            'social_links' => $this->social_links,
        ]);

        if ($this->avatar) {
            $path = $this->avatar->store('avatars','public');
            $this->trainer->update(['avatar' => $path]);
        }

        $this->->dispatchBrowserEvent('app-toast', ['title'=>'Saved','message'=>'Trainer profile updated','ttl'=>4000]);
        $this->loadTrainer();
    }

    public function render()
    {
        return view('livewire.admin.trainer-profile');
    }
}
