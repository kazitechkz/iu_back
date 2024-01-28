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
        Schema::create('career_quiz_questions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("quiz_id")->references("id")->on("career_quizzes")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("feature_id")->nullable()->references("id")->on("career_quiz_features")->nullOnDelete();
            $table->text("question_ru");
            $table->text("question_kk");
            $table->text("question_en")->nullable();
            $table->longText("context_ru")->nullable();
            $table->longText("context_kk")->nullable();
            $table->longText("context_en")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quiz_questions');
    }
};
