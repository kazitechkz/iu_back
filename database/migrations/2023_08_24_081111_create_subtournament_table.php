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
        Schema::create('sub_tournaments', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("tournament_id")->references("id")->on("tournaments")->cascadeOnDelete();
            $table->foreignId("step_id")->references("id")->on("tournament_steps")->cascadeOnDelete();
            $table->integer("question_quantity");
            $table->integer("max_point");
            $table->integer("single_question_quantity");
            $table->integer("multiple_question_quantity");
            $table->integer("context_question_quantity");
            $table->integer("time");
            $table->timestamp("start_at");
            $table->timestamp("end_at");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtournament');
    }
};
