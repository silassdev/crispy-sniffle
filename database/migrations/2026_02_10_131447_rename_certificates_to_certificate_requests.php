<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        if (Schema::hasTable('certificates') && ! 
        Schema::hasTable('certificate_requests')) {
                Schema::rename('certificates', 'certificate_requests');
        }
    }

    
    public function down(): void
    {
        if (Schema::hasTable('certificate_requests') && ! 
        Schema::hasTable('certificates')) {
                Schema::rename('certificate_requests', 'certificates');
        }
    }
};
