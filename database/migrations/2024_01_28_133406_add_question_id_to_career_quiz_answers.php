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
        Schema::table('career_quiz_answers', function (Blueprint $table) {
            $table->foreignId("question_id")->nullable()->references("id")->on("career_quiz_questions")->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_quiz_answers', function (Blueprint $table) {
            //
        });
    }
};
