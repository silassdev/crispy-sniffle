<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table = 'newsletter_subscribers';
    protected $fillable = ['name','email','country','interest','ip','subscribed_at'];
    protected $casts = ['subscribed_at' => 'datetime'];
}
