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
        Schema::create('career_quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("quiz_id")->references("id")->on("career_quizzes")->cascadeOnDelete();
            $table->string("title_ru");
            $table->string("title_kk");
            $table->string("title_en")->nullable();
            $table->integer("value")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quiz_answers');
    }
};
