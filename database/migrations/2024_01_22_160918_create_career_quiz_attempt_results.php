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
        Schema::create('career_quiz_attempt_results', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("attempt_id")->references("id")->on("career_quiz_attempts")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("feature_id")->references("id")->on("career_quiz_features")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("points");
            $table->float("percentage");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quiz_attempt_results');
    }
};
