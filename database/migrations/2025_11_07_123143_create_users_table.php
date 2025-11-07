<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();

          $table->timestamp('email_verified_at')->nullable();
          $table->string('password');

          $table->enum('role', ['student', 'trainer', 'admin'])->default('student');
          $table->boolean('approved')->default(false);
          $table->string('avatar')->nullable();
          $table->rememberToken();
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
