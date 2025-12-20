<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Post;
use App\Models\Reaction;

class PostInteraction extends Component
{
    public Post $post;
    public $reactionCounts = [];
    public $userReaction = null;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadReactions();
    }

    public function loadReactions()
    {
        // Get reaction counts grouped by type
        $reactions = $this->post->reactions()
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $this->reactionCounts = $reactions;

        // Get current user's reaction
        if (auth()->check()) {
            $userReactionModel = $this->post->reactions()
                ->where('user_id', auth()->id())
                ->first();
            
            $this->userReaction = $userReactionModel?->type;
        }
    }

    public function toggleReaction($type)
    {
        if (!auth()->check()) {
            $this->dispatch('app-toast', title: 'Login Required', message: 'Please login to react to posts', ttl: 4000);
            return;
        }

        $existingReaction = $this->post->reactions()
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReaction) {
            if ($existingReaction->type === $type) {
                // Remove reaction if clicking the same type
                $existingReaction->delete();
                $this->userReaction = null;
            } else {
                // Update to new reaction type
                $existingReaction->update(['type' => $type]);
                $this->userReaction = $type;
            }
        } else {
            // Create new reaction
            Reaction::create([
                'post_id' => $this->post->id,
                'user_id' => auth()->id(),
                'type' => $type,
            ]);
            $this->userReaction = $type;
        }

        $this->loadReactions();
        $this->dispatch('reaction-updated');
    }

    public function render()
    {
        return view('livewire.community.post-interaction');
    }
}
