<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrainerApprovedMail;
use App\Mail\TrainerRejectedMail;

class UserProfile extends Component
{
    public int $userId;
    public ?User $user = null;
    public ?string $role = null;

    // editable fields
    public $name;
    public $email;
    public $phone;
    public $bio;
    public $location;
    public $additional_info; // json/string
    public $badges; // array or comma-separated

    // confirm/delete state
    public ?int $confirmDeleteId = null;

    protected $rules = [];

    public function mount(int $userId, ?string $role = null)
    {
        $this->userId = $userId;
        $this->role = $role;
        $this->loadUser();
    }

    public function loadUser()
    {
        $this->user = User::findOrFail($this->userId);

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->bio = $this->user->bio;
        $this->location = $this->user->location;
        $this->additional_info = $this->user->additional_info;
        $this->badges = is_array($this->user->badges) ? implode(',', $this->user->badges) : ($this->user->badges ?? '');
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email','max:255', Rule::unique('users','email')->ignore($this->user->id)],
            'phone' => ['nullable','string','max:50'],
            'bio' => ['nullable','string','max:2000'],
            'location' => ['nullable','string','max:255'],
            'additional_info' => ['nullable'],
            'badges' => ['nullable','string'],
        ];
    }

    public function updated($prop)
    {
        // optional: real-time validation per-field
        $this->validateOnly($prop, $this->rules());
    }

    public function save()
    {
        $validated = $this->validate($this->rules());

        $this->user->name = $validated['name'];
        $this->user->email = $validated['email'];
        $this->user->phone = $validated['phone'] ?? null;
        $this->user->bio = $validated['bio'] ?? null;
        $this->user->location = $validated['location'] ?? null;
        $this->user->additional_info = $validated['additional_info'] ?? null;
        // badges: store as JSON array
        $this->user->badges = $validated['badges'] ? array_map('trim', explode(',', $validated['badges'])) : null;

        $this->user->save();

        $this->dispatchBrowserEvent('app-toast', ['title' => 'Saved', 'message' => 'Profile saved', 'ttl' => 4000]);
        $this->loadUser(); // refresh model
        $this->emit('refreshDashboardCounters');
    }

    public function confirmDelete()
    {
        $this->confirmDeleteId = $this->user->id;
    }

    public function destroyConfirmed()
    {
        $id = $this->confirmDeleteId;
        if (! $id) return;
        $u = User::findOrFail($id);
        $u->delete();
        $this->dispatchBrowserEvent('app-toast', ['title' => 'Deleted', 'message' => 'User removed', 'ttl' => 4000]);
        $this->confirmDeleteId = null;
        // after delete redirect to admin list
        return redirect()->route('admin.' . ($this->role === 'trainer' ? 'trainers' : ($this->role === 'student' ? 'students' : 'admins')));
    }

    public function sendPasswordReset()
    {
        if (! $this->user) return;
        $status = Password::sendResetLink(['email' => $this->user->email]);
        if ($status === Password::RESET_LINK_SENT) {
            $this->dispatchBrowserEvent('app-toast', ['title' => 'Sent', 'message' => 'Password reset email sent', 'ttl' => 4000]);
        } else {
            $this->dispatchBrowserEvent('app-toast', ['title' => 'Error', 'message' => 'Unable to send reset link', 'ttl' => 6000]);
        }
    }

    // trainer-specific actions
    public function approveTrainer()
    {
        if (! $this->user || $this->user->role !== User::ROLE_TRAINER) return;
        $this->user->approve(auth()->id());
        try {
            Mail::to($this->user->email)->send(new TrainerApprovedMail($this->user));
        } catch (\Throwable $e) {
            \Log::error('Trainer approval mail: '.$e->getMessage());
        }
        $this->dispatchBrowserEvent('app-toast', ['title' => 'Approved', 'message' => 'Trainer approved', 'ttl' => 4000]);
        $this->loadUser();
        $this->emit('refreshDashboardCounters');
    }

    public function rejectTrainer()
    {
        if (! $this->user || $this->user->role !== User::ROLE_TRAINER) return;
        $this->user->reject(auth()->id());
        try {
            Mail::to($this->user->email)->send(new TrainerRejectedMail($this->user));
        } catch (\Throwable $e) {
            \Log::error('Trainer rejected mail: '.$e->getMessage());
        }
        $this->dispatchBrowserEvent('app-toast', ['title' => 'Rejected', 'message' => 'Trainer rejected', 'ttl' => 4000]);
        $this->loadUser();
        $this->emit('refreshDashboardCounters');
    }

    public function exportJson()
    {
        if (! $this->user) return;
        $payload = $this->user->toArray();
        $filename = strtolower('user-' . $this->user->id . '.json');
        $this->dispatchBrowserEvent('download-user-json', ['filename' => $filename, 'data' => json_encode($payload, JSON_PRETTY_PRINT)]);
    }

    public function printProfile()
    {
        // trigger client-side print routine
        $this->dispatchBrowserEvent('print-user');
    }

    public function render()
    {
        return view('livewire.admin.user-profile');
    }
}
