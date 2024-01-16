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
        Schema::create('career_quiz_creator', function (Blueprint $table) {
            $table->id();
            $table->foreignId("quiz_id")->references("id")->on("career_quizzes")->cascadeOnDelete();
            $table->foreignId("author_id")->references("id")->on("career_quiz_authors")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quiz_creator');
    }
};
