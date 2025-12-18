<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Post;
use Psr\Log\LogLevel;

class GenerateWebP implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public int $postId;
    public int $timeout = 120;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    public function handle(): void
    {
        $post = Post::find($this->postId);
        if (! $post) {
            logger()->warning("GenerateWebP: post not found {$this->postId}");
            return;
        }

        $disk = Storage::disk('public');
        $source = $post->feature_image;
        if (! $source || ! $disk->exists($source)) {
            logger()->warning("GenerateWebP: feature image missing for post {$post->id}");
            return;
        }

        try {
            $tmp = $disk->path($source);
            $img = Image::make($tmp)->orientate();

            // produce a WebP for the full image (keep dimensions)
            $webpFullPath = $this->makePath('posts/webp', $source);
            $disk->put($webpFullPath, (string) $img->encode('webp', 85));

            // produce a small webp thumbnail
            $thumb = $img->clone()->fit(400, 250);
            $webpThumbPath = $this->makePath('posts/webp/thumbs', $source);
            $disk->put($webpThumbPath, (string) $thumb->encode('webp', 82));

            // update post meta with webp paths
            $meta = is_array($post->meta) ? $post->meta : ($post->meta ? (array)$post->meta : []);
            $meta['feature_webp'] = $webpFullPath;
            $meta['feature_webp_thumb'] = $webpThumbPath;
            $post->meta = $meta;
            $post->save();
        } catch (\Throwable $e) {
            logger()->log(LogLevel::ERROR, "GenerateWebP failed for post {$this->postId}: ".$e->getMessage());
            throw $e;
        }
    }

    protected function makePath(string $targetDir, string $originalPath): string
    {
        $basename = pathinfo($originalPath, PATHINFO_FILENAME);
        $filename = $basename . '-' . Str::random(6) . '.webp';
        return trim($targetDir, '/').'/'.$filename;
    }
}
