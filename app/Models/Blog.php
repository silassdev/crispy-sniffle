<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'status',        // draft|published
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Relationship: author (admin/user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for published posts
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Accessor: if excerpt is empty, generate one from body
     */
    public function getExcerptAttribute($value)
    {
        if (! empty($value)) {
            return $value;
        }

        // fallback: generate a short excerpt from body (strip tags)
        return Str::limit(strip_tags($this->body ?? ''), 150);
    }

    /**
     * Boot: auto-generate a unique slug when creating/updating if none provided
     */
    protected static function booted()
    {
        static::creating(function ($blog) {
            if (empty($blog->slug) && ! empty($blog->title)) {
                $blog->slug = static::makeUniqueSlug($blog->title);
            }
        });

        static::updating(function ($blog) {
            // if slug is empty on update, regenerate (avoids accidental blank slug)
            if (empty($blog->slug) && ! empty($blog->title)) {
                $blog->slug = static::makeUniqueSlug($blog->title, $blog->id);
            }
        });
    }

    /**
     * Helper: make unique slug
     */
    protected static function makeUniqueSlug($title, $ignoreId = null)
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $i++;
            $slug = $base . '-' . $i;
        }

        return $slug;
    }
}
