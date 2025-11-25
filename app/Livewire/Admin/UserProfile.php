<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\TrainerApprovedMail;
use App\Mail\TrainerRejectedMail;

class UserProfile extends Component
{
    public User $userId;
    public ?User $user = null;
    public ?string $role = null;

    // editable fields
    public array $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'bio' => '',
        'location' => '',
        'additional_info' => '',
        'badges' => '',
    ];
    // confirm/delete state
    public bool $confirmDelete = false;

    protected $listeners = [
        'refreshUser' => '$refresh',
    ];



    public function mount(User $user, $role = null)
    {
        $this->user = $user;
        $this->role = $role ?? $user->role;
        $this->form = array_merge($this->form, [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? null,
            'bio' => $user->bio ?? null,
            'location' => $user->location ?? null,
            'additional_info' => $user->additional_info ?? null,
            'badges' => $user->badges ?? null,
        ]);
    }

    protected function rules(): array
    {
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required','email','max:255', Rule::unique('users','email')->ignore($this->user->id)],
            'form.phone' => ['nullable','string','max:50'],
            'form.bio' => ['nullable','string','max:2000'],
            'form.location' => ['nullable','string','max:255'],
            'form.additional_info' => ['nullable'],
            'form.badges' => ['nullable','string'],
        ];
    }

    public function updateProfile()
    {
        $this->validate();

        try {
         $this->user->fill([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'phone' => $this->form['phone'],
            'bio' => $this->form['bio'],
            'location' => $this->form['location'],
            'additional_info' => $this->form['additional_info'],
            'badges' => $this->form['badges'],
            ]);
            $this->user->save();
            $this->dispatch('app-toast', type: 'error', message: 'Failed to approve');
            $this->emit('refreshUser');
            $this->emit('refreshDashboardCounters');
        } catch (\Throwable $e) {
            Log::error('UserProfile update failed:'.$e->getMessage());
            $this->dispatch('app-toast', type: 'error', message: 'Failed to save profile');
        }
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

    public function approve()
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403);
        };
        try {
            Mail::to($this->user->email)->send(new TrainerApprovedMail($this->user));
        } catch (\Throwable $e) {
            \Log::error('Trainer approval mail: '.$e->getMessage());
        }

        $this->user->approved = true;
        $this->user->rejected = false;
        $this->user->approved_at = now();
        $this->user->approved_by = auth()->id();
        $this->user->save();

        $this->dispatch('app-toast', type: 'success', message: 'Trainer approved');
        $this->loadUser();
        $this->emit('refreshDashboardCounters');
        $this->emitSelf('$refresh');
     } catch (\Throwable $e) {
        Log::error('UserProfile approve failed:'.$e->getMessage());
        $this->dispatch('app-toast', type: 'success', message: 'Trainer Rejected');
     }
    }

    public function confirmDelete()
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403);
        }
        $this->confirmDelete = true;
    }

     public function destroy()
    {
        if (! auth()->user()?->isAdmin()) {
            abort(403);
        }
        try {
            $name = $this->user->name;
            $this->user->delete();
            $this->dispatch('app-toast', type: 'success', message: 'Deleted');
        }
        if ($this->role === User::ROLE_TRAINER)
        {
         return 
         redirect()->route('admin.trainers');
        }
        if ($this->role === User::ROLE_STUDENT)
            return
         redirect()->route('admin.students');
       return
          redirect()->route('admin.admins');
    } catch (\Throwable $e) {
        Log::error('UserProfile delete failed:'.$e->getMessage());
        $this->dispatch('app-toast', type: 'success', message: 'Failed to Delete');
    

   

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
