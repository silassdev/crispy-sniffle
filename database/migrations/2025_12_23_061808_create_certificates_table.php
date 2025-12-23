<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number')->nullable()->unique(); // generated on approve
            $table->foreignId('course_id')->nullable()->constrained('courses')->nullOnDelete();
            $table->foreignId('trainer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->string('type'); // e.g. course_completion, graduation
            $table->text('notes')->nullable(); // trainer note or admin note
            $table->enum('status', ['pending','rejected','approved','revoked'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete(); // admin id
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
