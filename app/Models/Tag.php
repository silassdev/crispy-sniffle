<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {
    protected $fillable = ['name','slug'];
    public static function booted() {
        static::creating(fn($t)=> $t->slug = Str::slug($t->name));
    }
    public function posts(){ return $this->belongsToMany(Post::class); }
}
