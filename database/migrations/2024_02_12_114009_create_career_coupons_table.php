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
        Schema::create('career_coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('order_id');
            $table->foreignId('career_quiz_id')->references('id')->on('career_quizzes')->cascadeOnDelete();
            $table->foreignId('career_group_id')->references('id')->on('career_quiz_groups')->cascadeOnDelete();
            $table->boolean('is_used')->default(true);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_coupons');
    }
};
