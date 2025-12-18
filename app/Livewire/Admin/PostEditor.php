<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ResizePostImage;
use App\Jobs\GenerateWebP;

class PostEditor extends Component
{
    use WithFileUploads;

    public ?Post $post = null;
    public array $form = [
        'title' => '',
        'excerpt' => '',
        'body' => '',
        'status' => 'draft',
        'tags' => '',
    ];

    /** @var \Livewire\TemporaryUploadedFile|null */
    public $featureImage = null;

    public bool $isSaving = false;

    protected $listeners = [
        'post:refresh' => '$refresh',
    ];

    public function mount($postId = null)
    {
        if ($postId) {
            $this->post = Post::findOrFail($postId);
            $this->form = [
                'title' => $this->post->title,
                'excerpt' => $this->post->excerpt,
                'body' => $this->post->body,
                'status' => $this->post->status,
                'tags' => $this->post->tags->pluck('name')->join(', '),
            ];
        }
    }

    protected function rules(): array
    {
        $uniqueSlugRule = $this->post
            ? Rule::unique('posts', 'slug')->ignore($this->post->id)
            : Rule::unique('posts', 'slug');

        return [
            'form.title' => ['required', 'string', 'max:255'],
            'form.excerpt' => ['nullable', 'string', 'max:600'],
            'form.body' => ['nullable', 'string'],
            'form.status' => ['required', Rule::in(['draft','published'])],
            'featureImage' => ['nullable', 'image', 'max:2048'],
            'form.tags' => ['nullable','string','max:500'],
        ];
    }

    public function updatedFeatureImage()
    {
        $this->validateOnly('featureImage');
    }

    protected function parseTags(string $tagsString): array
    {
        $parts = array_filter(array_map('trim', explode(',', $tagsString)), fn($v) => $v !== '');
        $parts = array_unique($parts);
        return $parts;
    }

    public function save()
    {
        $this->isSaving = true;
        $this->validate();

        try {
            if (! $this->post) {
                $this->post = new Post();
                $this->post->author_id = auth()->id();
            }

            $this->post->title = $this->form['title'];
            $this->post->excerpt = $this->form['excerpt'];
            $this->post->body = $this->form['body'];
            $this->post->status = $this->form['status'];

            if ($this->form['status'] === 'published' && ! $this->post->published_at) {
                $this->post->published_at = now();
            }

            // slug generation for new posts or when title changed
            if (! $this->post->slug || Str::slug($this->form['title']) !== Str::before($this->post->slug, '-')) {
                $base = Str::slug($this->form['title']);
                $slug = $base;
                $i = 1;
                while (Post::where('slug', $slug)->where('id', '<>', $this->post->id ?? 0)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $this->post->slug = $slug;
            }

            // handle uploaded feature image using Spatie medialibrary
            if ($this->featureImage) {
                if ($this->post->feature_image) {
                    Storage::disk('public')->delete($this->post->feature_image);
                }
                $path = $this->featureImage->store('posts', 'public');
                $this->post->feature_image = $path;

                // Dispatch jobs to process the image
                dispatch(new ResizePostImage($path));
                dispatch(new GenerateWebP($path));
            }

            $this->post->save();
            $tmpPath = $this->featureImage->store('uploads/posts_raw', 'public'); // returns path like uploads/posts_raw/xxxxx.jpg
            $absolute = storage_path('app/public/'.$tmpPath);

             // attach to media library (this copies the file to media disk / media table)
            $this->post->addMedia($absolute)
           ->usingFileName(Str::slug(pathinfo($tmpPath, PATHINFO_FILENAME)) . '-' . Str::random(6) .'.'.pathinfo($tmpPath, PATHINFO_EXTENSION))
           ->toMediaCollection('feature_images');

            Storage::disk('public')->delete($tmpPath);

            // tags handling
            $tags = $this->parseTags($this->form['tags']);
            $tagIds = [];
            foreach ($tags as $t) {
                $tag = Tag::firstOrCreate(['slug' => Str::slug($t)], ['name' => $t]);
                $tagIds[] = $tag->id;
            }
            $this->post->tags()->sync($tagIds);

            $this->dispatch('app-toast', title: 'Saved', message: 'Post saved', ttl: 3000);
            $this->dispatch('post:refresh');
        } catch (\Throwable $e) {
            \Log::error('PostEditor save error: '.$e->getMessage());
            $this->dispatch('app-toast', title: 'Error', message: 'Unable to save post', ttl: 6000);
        } finally {
            $this->isSaving = false;
        }
    }

    public function removeFeatureImage()
    {
        if (! $this->post?->feature_image) return;
        Storage::disk('public')->delete($this->post->feature_image);

        $oldMeta = is_array($this->post->meta) ? $this->post->meta : ($this->post->meta ? (array)$this->post->meta : []);
        foreach (['feature_thumbnail','feature_small','feature_webp'] as $k) {
            if (!empty($oldMeta[$k])) Storage::disk('public')->delete($oldMeta[$k]);
        }

        $this->post->feature_image = null;
        $this->post->meta = array_filter($oldMeta, fn($v,$k) => !in_array($k,['feature_thumbnail','feature_small','feature_webp']), ARRAY_FILTER_USE_BOTH);
        $this->post->save();

        $this->dispatch('app-toast', title: 'Removed', message: 'Feature image removed', ttl: 3000);
    }

    public function render()
    {
        return view('livewire.admin.post-editor');
    }
}
