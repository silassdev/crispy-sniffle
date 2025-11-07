<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only run if table exists and FK not yet present
        if (! Schema::hasTable('social_accounts')) {
            return;
        }

        Schema::table('social_accounts', function (Blueprint $table) {
            // make sure the column exists and is the right type
            if (! Schema::hasColumn('social_accounts', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }

            // avoid adding duplicate foreign key
            // Laravel doesn't have a built-in check for FK names, so wrap in try/catch
            try {
                $table->foreign('user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');
            } catch (\Exception $e) {
                // do nothing if FK already exists or can't be added now
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('social_accounts')) {
            return;
        }

        Schema::table('social_accounts', function (Blueprint $table) {
            // try to drop foreign, ignore if missing
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
                // ignore
            }
        });
    }
};
