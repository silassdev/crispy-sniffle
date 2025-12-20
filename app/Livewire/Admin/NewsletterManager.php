<?php
namespace App\Livewire\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Str;

class NewsletterManager extends Component
{
    use WithPagination;
    public $q = '';
    public $perPage = 15;

    protected $queryString = ['q','page'];

    protected function notify($title,$message,$ttl=3000) {
        $payload = ['title'=>$title,'message'=>$message,'ttl'=>$ttl];
        if (method_exists($this,'dispatch')) $this->dispatch('app-toast',$payload);
        else $this->dispatchBrowserEvent('app-toast',$payload);
    }

    public function exportCsv()
    {
        $filename = 'subscribers-'.now()->format('Ymd-His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $rows = NewsletterSubscriber::when($this->q, fn($q)=>$q->where(function($s){
            $s->where('email','like','%'.$this->q.'%')->orWhere('name','like','%'.$this->q.'%');
        }))->orderByDesc('subscribed_at')->get();

        $callback = function() use ($rows) {
            $handle = fopen('php://output','w');
            fputcsv($handle, ['id','name','email','country','interest','subscribed_at']);
            foreach ($rows as $r) {
                fputcsv($handle, [$r->id,$r->name,$r->email,$r->country,$r->interest,$r->subscribed_at]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function delete($id)
    {
        NewsletterSubscriber::where('id',$id)->delete();
        $this->notify('Deleted','subscriber removed');
    }

    public function render()
    {
        $query = NewsletterSubscriber::query();
        if ($this->q) $query->where(fn($s)=> $s->where('email','like','%'.$this->q.'%')->orWhere('name','like','%'.$this->q.'%'));
        $subs = $query->orderByDesc('subscribed_at')->paginate($this->perPage);
        return view('livewire.admin.newsletter-manager', ['subs'=>$subs]);
    }
}
