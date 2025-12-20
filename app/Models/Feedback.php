<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = ['name','email','country','message','type','resolved','ip'];
    protected $casts = ['resolved' => 'boolean'];
}
