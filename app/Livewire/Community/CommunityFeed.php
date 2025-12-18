<?php

namespace App\Livewire\Community;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;

class CommunityFeed extends Component
{
    use WithPagination;

    public int $perPage = 10;
    public ?string $q = null;
    public ?string $tag = null;
    public ?string $postType = null;

    protected $updatesQueryString = ['q','tag','page','postType'];

    public function mount($postType = null)
    {
        $this->postType = $postType ? (string)$postType : null;
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    protected function applyTypeFilter($query)
    {
        // If a post_type column exists, use it
        if (Schema::hasColumn('posts', 'post_type')) {
            if ($this->postType) {
                return $query->where('post_type', $this->postType);
            }
            return $query; // null -> no filter
        }

        // fallback: check meta.is_community JSON flag
        if ($this->postType === 'community') {
            return $query->whereJsonContains('meta->is_community', true);
        }
        if ($this->postType === 'blog') {
            // blog = not community OR explicit blog flag
            return $query->where(function($q){
                $q->whereNull('meta')
                  ->orWhereJsonLength('meta', 0)
                  ->orWhereRaw("COALESCE(JSON_EXTRACT(meta, '$.is_community'), 'false') = 'false'");
            });
        }

        return $query;
    }

    public function render()
    {
        $query = Post::published()->with('author','tags')->latest('published_at');

        // apply type filter
        $query = $this->applyTypeFilter($query);

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
