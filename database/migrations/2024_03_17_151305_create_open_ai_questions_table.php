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
        Schema::create('open_ai_questions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("question_id")->references("id")->on("questions")->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->longText("answer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_ai_questions');
    }
};
