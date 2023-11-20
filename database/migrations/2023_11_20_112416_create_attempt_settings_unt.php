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
        Schema::create('attempt_settings_unt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('promo_code');
            $table->foreignId('locale_id')->references('id')->on('locales')->cascadeOnDelete();
            $table->foreignId("sender_id")->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('class_id')->nullable()->references('id')->on('classroom_groups')->nullOnDelete();
            $table->json("users")->nullable();
            $table->json("subjects");
            $table->json('settings')->nullable();
            $table->integer('time');
            $table->string('hidden_fields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_settings_unt');
    }
};
