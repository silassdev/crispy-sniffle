<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Post;
use Illuminate\Support\Str;
use Psr\Log\LogLevel;

class ResizePostImage implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public string $path;
    public int $postId;

    // seconds to run before killed by worker timeout (optional)
    public int $timeout = 120;

    public function __construct(string $path, int $postId)
    {
        $this->path = $path;
        $this->postId = $postId;
    }

    public function handle(): void
    {
        $disk = Storage::disk('public');
        if (!$disk->exists($this->path)) {
            logger()->warning("ResizePostImage: source file missing: {$this->path}");
            return;
        }

        $tmpSource = $disk->path($this->path);

        try {
            $img = Image::make($tmpSource);

            $this->processImage($img, $disk);

            $this->updateDatabase($disk);

            $this->cleanupOriginal($disk);
        } catch (\Throwable $e) {
            logger()->log(LogLevel::ERROR, 'ResizePostImage failed: '.$e->getMessage(), [
                'path' => $this->path, 'post_id' => $this->postId
            ]);
            throw $e;
        }
    }

    protected function processImage($img, $disk): void
    {
        $full = clone $img;
        $full->orientate();
        $full->resize(1600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $fullPath = $this->makePath('posts', $this->path);
        $disk->put($fullPath, (string) $full->encode('jpg', 85));

        $thumb = clone $img;
        $thumb->orientate();
        $thumb->fit(1200, 628);
        $thumbPath = $this->makePath('posts/thumbs', $this->path);
        $disk->put($thumbPath, (string) $thumb->encode('jpg', 82));

        $small = clone $img;
        $small->orientate();
        $small->fit(400, 250);
        $smallPath = $this->makePath('posts/small', $this->path);
        $disk->put($smallPath, (string) $small->encode('jpg', 82));
    }

    protected function updateDatabase($disk): void
    {
        $post = Post::find($this->postId);
        if ($post) {
            $post->feature_image = $this->makePath('posts', $this->path);
            $meta = is_array($post->meta) ? $post->meta : ($post->meta ? (array) $post->meta : []);
            $meta['feature_thumbnail'] = $this->makePath('posts/thumbs', $this->path);
            $meta['feature_small'] = $this->makePath('posts/small', $this->path);
            $post->meta = $meta;
            $post->save();
        }
    }

    protected function cleanupOriginal($disk): void
    {
        if ($this->path !== $this->makePath('posts', $this->path) && $disk->exists($this->path)) {
            $disk->delete($this->path);
        }
    }

    protected function makePath(string $targetDir, string $originalPath): string
    {
        $basename = pathinfo($originalPath, PATHINFO_FILENAME);
        $filename = $basename . '-' . Str::random(6) . '.jpg';
        return trim($targetDir, '/').'/'.$filename;
    }
}
