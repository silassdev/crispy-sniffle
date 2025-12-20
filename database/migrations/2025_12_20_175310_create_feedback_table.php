<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->text('message');
            $table->string('type')->nullable();
            $table->boolean('resolved')->default(false);
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
