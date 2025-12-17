<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Comment;

class Thread extends Component
{
    use WithPagination;

    public Post $post;
    public int $perPage = 10;
    public $body = '';
    public $replyTo = null; // comment id being replied to

    protected $listeners = ['refreshComments' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    protected function rules()
    {
        return ['body' => ['required','string','max:2000']];
    }

    public function add()
    {
        if (! auth()->check()) {
            $this->dispatchBrowserEvent('app-toast', ['title' => 'Login', 'message' => 'Please login to comment', 'ttl'=>4000]);
            return;
        }

        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'parent_id' => $this->replyTo,
            'body' => $this->body,
            'approved' => true,
        ]);

        $this->body = '';
        $this->replyTo = null;

        $this->dispatchBrowserEvent('app-toast', ['title'=>'Posted','message'=>'Comment added','ttl'=>3000]);
        $this->emitUp('comments:added');
        $this->resetPage();
    }

    public function startReply($commentId)
    {
        $this->replyTo = $commentId;
        $this->dispatchBrowserEvent('focus-comment-input');
    }

    public function cancelReply()
    {
        $this->replyTo = null;
    }

    public function render()
    {
        // top-level comments with eager-loaded children (one level)
        $comments = Comment::where('post_id', $this->post->id)
            ->whereNull('parent_id')
            ->with(['user','children.user'])
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.comments.thread', [
            'comments' => $comments,
        ]);
    }
}
