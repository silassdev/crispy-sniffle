<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title','slug','excerpt','body','author_id','feature_image','status','published_at','meta'];
    protected $casts = ['meta'=>'array','published_at'=>'datetime'];

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
}
