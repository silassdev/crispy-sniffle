<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class CommunityManager extends Component
{
    use WithPagination, WithFileUploads;

    public bool $readyToLoad = false;

    public int $perPage = 10;

    // new post form
    public array $form = [
        'title' => '',
        'body' => '',
        'tags' => '',
        'status' => 'draft',
    ];

    public $featureImage = null;

    public $confirmAction = null;
    public $confirmPayload = null;

    protected $listeners = ['refreshCommunity' => '$refresh'];

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    public function updatedFeatureImage()
    {
        $this->validateOnly('featureImage', ['featureImage' => 'nullable|image|max:4096']);
    }

    protected function rules(): array
    {
        return [
            'form.title' => ['nullable', 'string', 'max:255'],
            'form.body'  => ['required','string','max:5000'],
            'form.status'=> ['required', 'in:draft,published'],
            'form.tags'  => ['nullable','string','max:500'],
        ];
    }

    public function confirm(string $type, $payload = null)
    {
        $this->confirmAction = $type;
        $this->confirmPayload = $payload;
        $this->dispatchBrowserEvent('open-confirm-modal');
    }

    public function cancelConfirm()
    {
        $this->confirmAction = null;
        $this->confirmPayload = null;
    }

    public function runConfirmedAction()
    {
        if (! $this->confirmAction) return;
        $type = $this->confirmAction;
        $payload = $this->confirmPayload;
        $this->cancelConfirm();

        if ($type === 'publish' || $type === 'save-draft') {
            $this->savePost($type === 'publish' ? 'published' : 'draft');
            return;
        }

        if ($type === 'delete-post') {
            $this->deletePost($payload);
            return;
        }

        if ($type === 'ban-user') {
            $this->toggleBan((int)$payload, true);
            return;
        }

        if ($type === 'unban-user') {
            $this->toggleBan((int)$payload, false);
            return;
        }
    }

    protected function savePost(string $status)
    {
        $this->form['status'] = $status;
        $this->validate();

        try {
            $post = new Post();
            $post->title = $this->form['title'] ?: Str::limit(strip_tags($this->form['body']), 80);
            $post->excerpt = Str::limit(strip_tags($this->form['body']), 160);
            $post->body = $this->form['body'];
            $post->author_id = auth()->id();
            $post->status = $status;
            if ($status === 'published') $post->published_at = now();

            if ($this->featureImage) {
                $path = $this->featureImage->store('community', 'public');
                $post->feature_image = $path;
                // optionally dispatch resize job as you did in PostEditor
            }

            // ensure slug
            $post->slug = Str::slug($post->title ?: 'post-'.Str::random(6)).'-'.Str::random(6);

            $post->save();

            // tags
            if (! empty($this->form['tags'])) {
                $tags = array_filter(array_map('trim', explode(',', $this->form['tags'])));
                $tagIds = [];
                foreach ($tags as $t) {
                    $tg = \App\Models\Tag::firstOrCreate(['slug'=>Str::slug($t)], ['name'=>$t]);
                    $tagIds[] = $tg->id;
                }
                $post->tags()->sync($tagIds);
            }

            $this->resetForm();
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Saved','message'=>'Post created','ttl'=>3500]);
            $this->emit('refreshCommunity');
        } catch (\Throwable $e) {
            \Log::error('Community savePost failed: '.$e->getMessage());
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Unable to save post','ttl'=>6000]);
        }
    }

    protected function resetForm()
    {
        $this->form = ['title'=>'','body'=>'','tags'=>'','status'=>'draft'];
        $this->featureImage = null;
    }

    public function deletePost(int $postId)
    {
        try {
            $p = Post::findOrFail($postId);
            $p->delete();
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Deleted','message'=>'Post deleted','ttl'=>3500]);
            $this->emit('refreshCommunity');
        } catch (\Throwable $e) {
            \Log::error('Community deletePost failed: '.$e->getMessage());
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Unable to delete','ttl'=>6000]);
        }
    }

    /**
     * Toggle a banned flag on users. If `banned` column missing, show instructive toast.
     */
    public function toggleBan(int $userId, bool $ban = true)
    {
        if (! Schema::hasColumn('users', 'banned')) {
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Missing column','message'=>'Add boolean users.banned column to enable ban/unban','ttl'=>8000]);
            return;
        }

        try {
            $user = User::findOrFail($userId);
            $user->banned = $ban ? 1 : 0;
            $user->save();
            $this->dispatchBrowserEvent('app-toast', ['title'=> $ban ? 'Banned' : 'Unbanned','message'=>$user->name,'ttl'=>3000]);
            $this->emit('refreshCommunity');
        } catch (\Throwable $e) {
            \Log::error('Community toggleBan failed: '.$e->getMessage());
            $this->dispatchBrowserEvent('app-toast', ['title'=>'Error','message'=>'Unable to update user','ttl'=>6000]);
        }
    }

    public function render()
    {
        $posts = collect();
        if ($this->readyToLoad) {
            $posts = Post::with('author','tags','comments')
                ->latest('created_at')
                ->paginate($this->perPage);
        }

        $counters = [
            'total_posts' => Post::count(),
            'published' => Post::where('status','published')->count(),
            'drafts' => Post::where('status','draft')->count(),
        ];

        return view('livewire.admin.community-manager', [
            'posts' => $posts,
            'counters' => $counters,
        ]);
    }
}
