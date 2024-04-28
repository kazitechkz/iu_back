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
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->references('id')->on('surveys')->cascadeOnDelete();
            $table->foreignId('locale_id')->references('id')->on('locales')->cascadeOnDelete();
            $table->text('text');
            $table->string('answer_a')->nullable();
            $table->string('answer_b')->nullable();
            $table->string('answer_c')->nullable();
            $table->string('answer_d')->nullable();
            $table->string('answer_e')->nullable();
            $table->string('answer_f')->nullable();
            $table->string('own_answer')->nullable();
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_questions');
    }
};
