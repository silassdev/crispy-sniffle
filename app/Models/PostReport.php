<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model {
    protected $fillable = ['post_id','user_id','type'];
    public function user(){ return $this->belongsTo(User::class); }
    public function post(){ return $this->belongsTo(Post::class); }
}