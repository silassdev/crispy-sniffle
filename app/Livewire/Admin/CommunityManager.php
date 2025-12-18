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
        'status' => 'draft', // draft|published
    ];

    public $featureImage = null; // Livewire file upload

    public $confirmAction = null; // 'publish'|'save-draft'|'delete-post'|'ban-user'|'unban-user'|'abandon'
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

    /**
     * Safe notification helper: uses $this->dispatch (Livewire v3) if available,
     * otherwise falls back to dispatchBrowserEvent.
     */
    protected function notify(string $title, string $message, int $ttl = 3000): void
    {
        $payload = ['title' => $title, 'message' => $message, 'ttl' => $ttl];
        if (method_exists($this, 'dispatch')) {
            $this->dispatch('app-toast', $payload);
        } else {
            $this->dispatchBrowserEvent('app-toast', $payload);
        }
    }

    /**
     * Safe trigger for generic client events (like opening confirm modal).
     */
    protected function trigger(string $name, array $payload = []): void
    {
        if (method_exists($this, 'dispatch')) {
            $this->dispatch($name, $payload);
        } else {
            $this->dispatchBrowserEvent($name, $payload);
        }
    }

    public function confirm(string $type, $payload = null)
    {
        $this->confirmAction = $type;
        $this->confirmPayload = $payload;
        // open confirm modal on client
        $this->trigger('open-confirm-modal');
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

        switch ($type) {
            case 'publish':
                $this->savePost('published');
                return;
            case 'save-draft':
                $this->savePost('draft');
                return;
            case 'delete-post':
                if ($payload) $this->deletePost((int)$payload);
                return;
            case 'ban-user':
                if ($payload) $this->toggleBan((int)$payload, true);
                return;
            case 'unban-user':
                if ($payload) $this->toggleBan((int)$payload, false);
                return;
            case 'abandon':
                $this->resetForm();
                return;
            default:
                // unknown action
                $this->notify('Error', 'Unknown action', 4000);
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
                // if you use medialibrary, replace above with addMedia flow
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
            $this->notify('Saved', 'Post created', 3500);
            $this->emit('refreshCommunity');
        } catch (\Throwable $e) {
            \Log::error('Community savePost failed: '.$e->getMessage());
            $this->notify('Error', 'Unable to save post', 6000);
        }
    }

    protected function resetForm()
    {
        $this->form = ['title'=>'','body'=>'','tags'=>'','status'=>'draft'];
        // clear file input
        $this->featureImage = null;
        // clear validation errors
        $this->resetValidation();
        // emit refresh so lists update
        $this->emit('refreshCommunity');
        $this->notify('Reset', 'Form cleared', 1500);
    }

    public function deletePost(int $postId)
    {
        try {
            $p = Post::findOrFail($postId);
            $p->delete();
            $this->notify('Deleted', 'Post deleted', 3500);
            $this->emit('refreshCommunity');
        } catch (\Throwable $e) {
            \Log::error('Community deletePost failed: '.$e->getMessage());
            $this->notify('Error', 'Unable to delete', 6000);
        }
    }

    /**
     * Toggle a banned flag on users. If `banned` column missing, notify instructive message.
     */
    public function toggleBan(int $userId, bool $ban = true)
    {
        if (! Schema::hasColumn('users', 'banned')) {
            $this->notify('Missing column', 'Add boolean users.banned column to enable ban/unban', 8000);
            return;
        }

        try {
            $user = User::findOrFail($userId);
            $user->banned = $ban ? 1 : 0;
            $user->save();
            $this->notify($ban ? 'Banned' : 'Unbanned', $user->name, 3000);
            $this->emit('refreshCommunity');
        } catch (\Throwable $e) {
            \Log::error('Community toggleBan failed: '.$e->getMessage());
            $this->notify('Error', 'Unable to update user', 6000);
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
