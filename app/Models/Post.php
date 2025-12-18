<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title','slug','excerpt','body','author_id','status','published_at','meta'];

    protected $casts = [
        'meta' => 'array',
        'published_at' => 'datetime',
    ];

    public static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug)) $post->slug = Str::slug($post->title).'-'.Str::random(6);
        });
    }

    public function author() { return $this->belongsTo(User::class,'author_id'); }
    public function tags() { return $this->belongsToMany(Tag::class); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function reactions() { return $this->hasMany(Reaction::class); }

    public function scopePublished($q) {
        return $q->where('status','published')->whereNotNull('published_at')->where('published_at','<=',now());
    }

    /**
     * Register conversions. These will be queued when perform_conversions_on_queue = true.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        // feature optimized (max width)
        $this->addMediaConversion('feature')
            ->fit(Manipulations::FIT_MAX, 1600, 1600)
            ->quality(85)
            ->performOnCollections('feature_images');

        // social card crop
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 1200, 628)
            ->quality(82)
            ->performOnCollections('feature_images');

        // small preview
        $this->addMediaConversion('small')
            ->fit(Manipulations::FIT_CROP, 400, 250)
            ->quality(82)
            ->performOnCollections('feature_images');

        // webp conversions
        $this->addMediaConversion('feature_webp')
            ->fit(Manipulations::FIT_MAX, 1600, 1600)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(80)
            ->performOnCollections('feature_images');

        $this->addMediaConversion('thumb_webp')
            ->fit(Manipulations::FIT_CROP, 1200, 628)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(80)
            ->performOnCollections('feature_images');
    }
}
