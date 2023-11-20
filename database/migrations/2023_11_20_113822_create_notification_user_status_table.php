<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_user_status', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("user_id")->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId("notification_id")->references('id')->on('notifications')->cascadeOnDelete();
            $table->boolean("is_read")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_user_status');
    }
};
