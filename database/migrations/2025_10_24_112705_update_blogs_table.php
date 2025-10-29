<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBlogsTable extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->string('title'); 
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); 
            $table->text('body');
            $table->string('featured_image')->nullable(); 
            $table->string('status')->default('draft'); 
            $table->timestamp('published_at')->nullable(); 
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'title',
                'slug',
                'excerpt',
                'body',
                'featured_image',
                'status',
                'published_at'
            ]);
            $table->dropSoftDeletes();
        });
    }
}