<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->nullable()->index();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedTinyInteger('order')->default(0);
            $table->boolean('locked')->default(false);
            $table->timestamps();
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
