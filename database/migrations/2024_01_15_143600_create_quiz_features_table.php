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
        Schema::create('career_quiz_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->foreignId("quiz_id")->references("id")->on("career_quizzes")->cascadeOnDelete();
            $table->string("title_ru");
            $table->string("title_kk");
            $table->string("title_en")->nullable();
            $table->text("description_ru");
            $table->text("description_kk");
            $table->text("description_en")->nullable();
            $table->text("activity_ru");
            $table->text("activity_kk");
            $table->text("activity_en")->nullable();
            $table->text("prospect_ru");
            $table->text("prospect_kk");
            $table->text("prospect_en")->nullable();
            $table->text("meaning_ru");
            $table->text("meaning_kk");
            $table->text("meaning_en")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quiz_features');
    }
};
