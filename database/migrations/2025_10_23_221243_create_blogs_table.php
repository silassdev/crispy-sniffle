<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Only add columns if they don't already exist (safe for partial schemas)
            if (! Schema::hasColumn('blogs', 'status')) {
                $table->string('status')->default('draft')->after('body');
            }

            if (! Schema::hasColumn('blogs', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('status');
            }

            if (! Schema::hasColumn('blogs', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('excerpt');
            }

            if (! Schema::hasColumn('blogs', 'slug')) {
                $table->string('slug')->nullable()->after('title');
                // NOTE: don't create a unique index here in case duplicates exist.
                // Add a unique constraint later once you ensure slugs are unique.
            }

            if (! Schema::hasColumn('blogs', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('blogs', 'published_at')) {
                $table->dropColumn('published_at');
            }
            if (Schema::hasColumn('blogs', 'featured_image')) {
                $table->dropColumn('featured_image');
            }
            if (Schema::hasColumn('blogs', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('blogs', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};
