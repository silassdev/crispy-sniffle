<?php

namespace App\Livewire\Community;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class CommunityFeed extends Component
{
    use WithPagination;

    public int $perPage = 10;
    public ?string $q = null;
    public ?string $tag = null;

    protected $updatesQueryString = ['q','tag','page'];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Post::published()->with('author','tags')->latest('published_at');

        if ($this->q) {
            $query->where(function($q){
                $q->where('title','like','%'.$this->q.'%')
                  ->orWhere('body','like','%'.$this->q.'%')
                  ->orWhere('excerpt','like','%'.$this->q.'%');
            });
        }

        if ($this->tag) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $this->tag));
        }

        $posts = $query->paginate($this->perPage);

        return view('livewire.community.community-feed', [
            'posts' => $posts
        ]);
    }
}
