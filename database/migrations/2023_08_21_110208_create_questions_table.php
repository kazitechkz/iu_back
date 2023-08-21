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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('context')->nullable(true);
            $table->text('text');
            $table->text('answer_a');
            $table->text('answer_b');
            $table->text('answer_c');
            $table->text('answer_d');
            $table->text('answer_e');
            $table->text('answer_f')->nullable(true);
            $table->text('answer_g')->nullable(true);
            $table->text('answer_h')->nullable(true);
            $table->char('correct_answers');
            $table->text('prompt')->nullable(true);
            $table->string('prompt_image')->nullable(true);
            $table->text('explanation')->nullable(true);
            $table->string('explanation_image')->nullable(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreignId('locale_id')->references('id')->on('locales')->onDelete('cascade');
            $table->foreignId('type_id')->references('id')->on('question_types')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
