<?php
namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class TrainerList extends Component
{
    use WithPagination;
    public $q = '';
    public $sort = 'created_at';
    public $dir = 'desc';
    public $perPage = 10;

    protected $listeners = ['deleteTrainer' => 'delete'];

    public function updatingQ(){ $this->resetPage(); }
    public function updatingPerPage(){ $this->resetPage(); }

    public function delete($id)
    {
        $user = User::find($id);
        if($user && $user->role === User::ROLE_TRAINER){
            $user->delete();
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Deleted','message'=>'Trainer deleted','ttl'=>4000]);
        }
    }

    public function render()
    {
        $query = User::where('role', User::ROLE_TRAINER)
            ->when($this->q, fn($q)=>$q->where(fn($q2)=>$q2->where('name','like',"%{$this->q}%")->orWhere('email','like',"%{$this->q}%")))
            ->orderBy($this->sort, $this->dir);

        $list = $query->paginate($this->perPage);

        return view('livewire.admin.trainer-list', ['trainers' => $list]);
    }
}
