<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class CommentsManage extends Component
{
    use WithPagination;

    public ?Post $post = null;
    public $open = false;
    public int $perPage = 10;
    public ?int $postId = null;

    protected $listeners = [
        'openComments' => 'openForPost',
        'refreshComments' => '$refresh',
    ];

    public function openForPost($payload)
    {
        // payload can be {id: X} or just an integer
        $id = is_array($payload) && isset($payload['id']) ? $payload['id'] : (int)$payload;
        $this->postId = (int) $id;
        $this->post = Post::withCount('comments')->find($this->postId);
        if (! $this->post) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Not found','message'=>'Post not found','ttl'=>4000]);
            return;
        }
        $this->open = true;
        $this->resetPage();
    }

    public function approveComment(int $commentId)
    {
        $c = Comment::findOrFail($commentId);
        $c->approved = true;
        $c->save();
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Approved','message'=>'Comment approved','ttl'=>3000]);
        $this->emit('refreshComments');
    }

    public function rejectComment(int $commentId)
    {
        $c = Comment::findOrFail($commentId);
        $c->approved = false;
        $c->save();
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Rejected','message'=>'Comment rejected','ttl'=>3000]);
        $this->emit('refreshComments');
    }

    public function deleteComment(int $commentId)
    {
        $c = Comment::findOrFail($commentId);
        $c->delete();
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Deleted','message'=>'Comment deleted','ttl'=>3000]);
        $this->emit('refreshComments');
    }

    public function banUser(int $userId)
    {
        if (! Schema::hasColumn('users','banned')) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Missing column','message'=>'Add users.banned boolean column to enable ban/unban','ttl'=>7000]);
            return;
        }
        $u = User::findOrFail($userId);
        $u->banned = 1;
        $u->save();
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Banned','message'=>$u->name,'ttl'=>3000]);
        $this->emit('refreshComments');
    }

    public function unbanUser(int $userId)
    {
        if (! Schema::hasColumn('users','banned')) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Missing column','message'=>'Add users.banned boolean column to enable ban/unban','ttl'=>7000]);
            return;
        }
        $u = User::findOrFail($userId);
        $u->banned = 0;
        $u->save();
        $this->dispatchBrowserEvent('app-toast', ['title'=>'Unbanned','message'=>$u->name,'ttl'=>3000]);
        $this->emit('refreshComments');
    }

    public function close()
    {
        $this->open = false;
        $this->post = null;
        $this->postId = null;
        $this->resetPage();
    }

    public function render()
    {
        $comments = collect();
        if ($this->postId) {
            $comments = Comment::where('post_id', $this->postId)
                ->with('user')
                ->orderByDesc('created_at')
                ->paginate($this->perPage);
        }

        return view('livewire.admin.comments-manage', [
            'comments' => $comments,
            'post' => $this->post,
        ]);
    }
}
