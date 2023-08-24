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
        Schema::create('attempt_questions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("attempt_subject_id")->references("id")->on("attempt_subjects")->cascadeOnDelete();
            $table->foreignId("question_id")->references("id")->on("questions")->cascadeOnDelete();
            $table->integer("point")->default(0);
            $table->boolean("is_right")->default(false);
            $table->text("user_answer")->nullable();
            $table->boolean("is_answered")->default(false);
            $table->boolean("is_skipped")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_questions');
    }
};
