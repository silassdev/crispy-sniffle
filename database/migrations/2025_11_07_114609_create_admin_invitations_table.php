<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // avoid re-creating if table already exists
        if (Schema::hasTable('admin_invitations')) {
            return;
        }

        Schema::create('admin_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable()->index();
            $table->string('token')->unique();

            // just create the column here
            $table->unsignedBigInteger('inviter_id')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            // created_at and updated_at
            $table->timestamps();

            // helpful indexes
            $table->index('inviter_id');
        });

        // Add FK only if users table exists (prevents ordering errors)
        if (Schema::hasTable('users')) {
            Schema::table('admin_invitations', function (Blueprint $table) {
                // wrap in try/catch to be extra-safe
                try {
                    $table->foreign('inviter_id')
                          ->references('id')
                          ->on('users')
                          ->onDelete('set null');
                } catch (\Throwable $e) {
                    // ignore if FK can't be added now
                }
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('admin_invitations')) {
            return;
        }

        Schema::table('admin_invitations', function (Blueprint $table) {
            try {
                $table->dropForeign(['inviter_id']);
            } catch (\Throwable $e) {
                // ignore if FK doesn't exist
            }
        });

        Schema::dropIfExists('admin_invitations');
    }
};
