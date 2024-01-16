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
        Schema::create('career_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("group_id")->references("id")->on("career_quiz_groups")->cascadeOnDelete();
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->string("title_ru");
            $table->string("title_kk");
            $table->string("title_en")->nullable();
            $table->text("description_ru");
            $table->text("description_kk");
            $table->text("description_en")->nullable();
            $table->text("rule_ru");
            $table->text("rule_kk");
            $table->text("rule_en")->nullable();
            $table->integer("price")->default(0);
            $table->string("currency",20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quizzes');
    }
};
