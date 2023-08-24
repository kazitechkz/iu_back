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
        Schema::create('single_subject_tests', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('subject_id');
            $table->integer('single_answer_questions_quantity')->nullable(true);
            $table->integer('contextual_questions_quantity')->nullable(true);
            $table->integer('multi_answer_questions_quantity')->nullable(true);
            $table->integer('allotted_time')->default(60);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('single_subject_tests');
    }
};
