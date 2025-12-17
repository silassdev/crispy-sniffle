<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Support\Facades\DB;

class PostShow extends Component
{
    public Post $post;
    public ?string $userReaction = null;

    protected $listeners = ['comments:added' => '$refresh'];

    public function mount($slug)
    {
        $this->post = Post::with('author','tags')->where('slug', $slug)->firstOrFail();

        // increment views (simple, atomic)
        try {
            DB::table('posts')->where('id', $this->post->id)->increment('views');
            $this->post->views++;
        } catch (\Throwable $e) {
            \Log::warning('Post view increment failed: '.$e->getMessage());
        }

        $this->userReaction = optional(auth()->user())->id
            ? Reaction::where('post_id', $this->post->id)->where('user_id', auth()->id())->pluck('type')->first()
            : null;
    }

    public function toggleReaction($type)
    {
        if (! auth()->check()) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Login','message'=>'Please login to react','ttl'=>4000]);
            return;
        }

        $existing = Reaction::where('post_id', $this->post->id)->where('user_id', auth()->id())->where('type',$type)->first();

        if ($existing) {
            $existing->delete();
            $this->userReaction = null;
        } else {
            // remove other types if any: we allow one reaction per user per post
            Reaction::where('post_id', $this->post->id)->where('user_id', auth()->id())->delete();
            Reaction::create([
                'post_id' => $this->post->id,
                'user_id' => auth()->id(),
                'type' => $type,
            ]);
            $this->userReaction = $type;
        }

        $this->emitSelf('$refresh');
    }

    public function report($reason = null)
    {
        if (! auth()->check()) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Login','message'=>'Please login to report','ttl'=>4000]);
            return;
        }

        try {
            $this->post->reports()->create([
                'user_id' => auth()->id(),
                'reason' => $reason ?? null,
            ]);
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Reported','message'=>'Post reported to admins','ttl'=>4000]);
        } catch (\Throwable $e) {
            \Log::error('Post report failed: '.$e->getMessage());
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Report failed','ttl'=>4000]);
        }
    }

    public function render()
    {
        $commentsCount = $this->post->comments()->count();
        $reactions = $this->post->reactions()->selectRaw('type, count(*) as total')->groupBy('type')->get();

        return view('livewire.post-show', [
            'reactions' => $reactions,
            'commentsCount' => $commentsCount,
        ]);
    }
}
