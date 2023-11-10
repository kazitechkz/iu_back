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
        Schema::create('attempt_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('promo_code');
            $table->foreignId('class_id')->nullable()->references('id')->on('classroom_groups')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->json('settings');
            $table->foreignId('locale_id')->references('id')->on('locales')->cascadeOnDelete();
            $table->integer('time');
            $table->string('hidden_fields')->nullable();
            $table->integer('point')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_settings');
    }
};
