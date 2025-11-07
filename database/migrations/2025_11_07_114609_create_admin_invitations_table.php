<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up():void
    {
        Schema::create('admin_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable()->index();
            $table->string('token')->unique();

        $table->unsignedBigInteger('inviter_id')->nullable();
            $table->timestamps('used_at')->nullable();
            $table->timestamps('expires_at')->nullable();
            $table->timestamps();

        $table->foreign('inviter_id')->refrences('id')->on('users')->onDelete('set null');
        });
    }

    public function down():void
    {
        Schema::dropIfExists('admin_invitations');
    }
};
