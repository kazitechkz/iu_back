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
        Schema::create('battle_step_questions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("step_id")->references("id")->on("battle_steps")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("question_id")->references("id")->on("questions")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("responded_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("answer")->nullable();
            $table->boolean("is_right")->nullable();
            $table->integer("point")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battle_step_questions');
    }
};
