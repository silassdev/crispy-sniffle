<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained('assessments')->cascadeOnDelete();
            $table->enum('type',['mcq','written'])->default('mcq');
            $table->text('question_text');
            $table->json('options')->nullable(); 
            $table->string('correct_option')->nullable();
            $table->integer('score')->default(1);
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
