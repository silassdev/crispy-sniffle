<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('certificate_requests', 'rejected_by')) {
                $table->foreignId('rejected_by')->nullable()->after('approved_by')->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('certificate_requests', 'admin_note')) {
                $table->text('admin_note')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('certificate_requests', 'certificate_path')) {
                $table->string('certificate_path')->nullable()->after('status');
            }
        });
    }

    
    public function down(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            if (Schema::hasColumn('certificate_requests', 'rejected_by')) {
                $table->dropForeign(['rejected_by']);
                $table->dropColumn('rejected_by');
            }
            if (Schema::hasColumn('certificate_requests', 'admin_note')) {
                $table->dropColumn('admin_note');
            }
        });
    }
};
