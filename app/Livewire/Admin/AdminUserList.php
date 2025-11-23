<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminInviteMail;
use App\Models\AdminInvitation; // optional if you use an invitation model

class AdminUserList extends Component
{
    use WithPagination;

    public int $perPage = 12;
    public string $search = '';
    public ?int $viewingId = null;
    public ?User $viewingAdmin = null;
    public ?int $confirmDeleteId = null;

    public string $inviteEmail = '';

    protected $paginationTheme = 'tailwind';
    protected $listeners = ['refreshAdmins' => '$refresh'];

    public function updatingSearch() { $this->resetPage(); }

    public function updatedViewingId($val) { $this->viewingAdmin = $val ? User::find($val) : null; }

    public function confirmDelete(int $id) { $this->confirmDeleteId = $id; }

    public function destroyConfirmed()
    {
        $id = $this->confirmDeleteId;
        if (! $id) return;
        $admin = User::findOrFail($id);
        if ($admin->role !== User::ROLE_ADMIN) {
            $this->dispatchBrowserEvent('app-toast',['title'=>'Error','message'=>'Not an admin','ttl'=>4000]);
            $this->confirmDeleteId = null;
            return;
        }
        $admin->delete();
        $this->dispatchBrowserEvent('app-toast',['title'=>'Deleted','message'=>'Admin removed','ttl'=>4000]);
        $this->confirmDeleteId = null;
        $this->resetPage();
    }

    public function sendReset(int $id)
    {
        $user = User::findOrFail($id);
        if ($user->role !== User::ROLE_ADMIN) {
            $this->dispatchBrowserEvent('app-toast',['title'=>'Error','message'=>'Not an admin','ttl'=>4000]);
            return;
        }

        $status = Password::sendResetLink(['email' => $user->email]);
        if ($status === Password::RESET_LINK_SENT) {
            $this->dispatchBrowserEvent('app-toast',['title'=>'Sent','message'=>'Password reset sent','ttl'=>4000]);
        } else {
            $this->dispatchBrowserEvent('app-toast',['title'=>'Error','message'=>'Unable to send reset','ttl'=>4000]);
        }
    }

    public function inviteAdmin()
    {
        $this->validate(['inviteEmail' => 'required|email']);
        $token = Str::random(48);

        // optionally create admin invitation record
        try {
            if (class_exists(AdminInvitation::class)) {
                AdminInvitation::create([
                    'email' => $this->inviteEmail,
                    'token' => $token,
                    'invited_by' => auth()->id(),
                ]);
            }
        } catch (\Throwable $e) {
            \Log::warning('AdminInvitation create failed: '.$e->getMessage());
        }

        try {
            Mail::to($this->inviteEmail)->send(new AdminInviteMail($this->inviteEmail, $token));
        } catch (\Throwable $e) {
            \Log::error('Admin invite mail failed: '.$e->getMessage());
            $this->dispatchBrowserEvent('app-toast',['title'=>'Error','message'=>'Invite email failed','ttl'=>5000]);
            return;
        }

        $this->dispatchBrowserEvent('app-toast',['title'=>'Invited','message'=>'Invite sent','ttl'=>4000]);
        $this->inviteEmail = '';
        $this->emit('refreshAdmins');
    }

    public function render()
    {
        $query = User::where('role', User::ROLE_ADMIN)
            ->when($this->search, fn($q) => $q->where(fn($s) =>
                $s->where('name','like','%'.$this->search.'%')->orWhere('email','like','%'.$this->search.'%')
            ))
            ->orderByDesc('created_at');

        $admins = $query->paginate($this->perPage);

        return view('livewire.admin.admin-user-list', compact('admins'));
    }
}
