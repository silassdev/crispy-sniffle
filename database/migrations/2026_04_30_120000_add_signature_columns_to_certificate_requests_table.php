<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('certificate_requests', 'administrator_signature')) {
                $table->longText('administrator_signature')->nullable()->after('certificate_path');
            }
            if (!Schema::hasColumn('certificate_requests', 'signed_at')) {
                $table->timestamp('signed_at')->nullable()->after('administrator_signature');
            }
        });
    }

    public function down(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            if (Schema::hasColumn('certificate_requests', 'administrator_signature')) {
                $table->dropColumn('administrator_signature');
            }
            if (Schema::hasColumn('certificate_requests', 'signed_at')) {
                $table->dropColumn('signed_at');
            }
        });
    }
};
