<?php
namespace App\Livewire\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Feedback;

class FeedbackManager extends Component
{
    use WithPagination;
    public $q = '';
    public $perPage = 15;
    public $viewing = null; // feedback id being viewed

    protected function notify($title,$message,$ttl=3000) {
        $payload = ['title'=>$title,'message'=>$message,'ttl'=>$ttl];
        if (method_exists($this,'dispatch')) $this->dispatch('app-toast',$payload);
        else $this->dispatchBrowserEvent('app-toast',$payload);
    }

    public function view($id) { $this->viewing = $id; }

    public function markResolved($id)
    {
        $f = Feedback::findOrFail($id);
        $f->resolved = true;
        $f->save();
        $this->notify('Updated','Marked resolved');
    }

    public function delete($id) { Feedback::where('id',$id)->delete(); $this->notify('Deleted','Feedback removed'); }

    public function render()
    {
        $q = Feedback::query();
        if ($this->q) $q->where(function($s){ $s->where('email','like','%'.$this->q.'%')->orWhere('name','like','%'.$this->q.'%')->orWhere('message','like','%'.$this->q.'%'); });
        $items = $q->orderByDesc('created_at')->paginate($this->perPage);
        $viewItem = $this->viewing ? Feedback::find($this->viewing) : null;
        return view('livewire.admin.feedback-manager', compact('items','viewItem'));
    }
}
