<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->string('employment_type')->nullable(); // e.g. Full-time, Part-time, Contract
            $table->string('salary')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true); // green/red indicator
            $table->unsignedBigInteger('created_by')->nullable();
            $table->json('tech_stack')->nullable(); // array of strings
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable(); // markdown / html
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
