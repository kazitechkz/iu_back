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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('type_id')->references('id')->on('notification_types')->cascadeOnDelete();
            $table->foreignId('class_id')->nullable()->references('id')->on('classroom_groups')->nullOnDelete();
            $table->foreignId("owner_id")->nullable()->references('id')->on('users')->nullOnDelete();
            $table->json("users")->nullable();
            $table->string("title",255);
            $table->text("message");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
