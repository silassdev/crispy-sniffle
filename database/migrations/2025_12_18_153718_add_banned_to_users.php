<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
         if (! Schema::hasColumn('users','banned')) {
      Schema::table('users', function (Blueprint $t) {
        $t->boolean('banned')->default(false)->after('remember_token');
      });
    }
}
   
    public function down(): void
    {
        if (Schema::hasColumn('users','banned')) {
      Schema::table('users', function (Blueprint $t){
        $t->dropColumn('banned');
      });
      }
    }
};
