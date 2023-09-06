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
        Schema::create('sub_step_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('sub_step_id')->references('id')->on('sub_steps')->cascadeOnDelete();
            $table->foreignId('sub_question_id')->references('id')->on('sub_questions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_step_tests');
    }
};
