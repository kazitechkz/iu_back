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
        Schema::create('methodist_content_stats', function (Blueprint $table) {
            $table->bigIncrements("id");
            //Отслеживаем категорию
            $table->foreignId("category_id")->nullable()->references("id")->on("categories")->nullOnDelete();
            $table->foreignId("sub_category_id")->nullable()->references("id")->on("sub_categories")->nullOnDelete();
            //Отслеживаем Этапы Субэтапы
            $table->foreignId("step_id")->nullable()->references("id")->on("steps")->nullOnDelete();
            $table->foreignId("sub_step_id")->nullable()->references("id")->on("sub_steps")->nullOnDelete();
            //Контентная часть
            $table->foreignId("sub_step_content_id")->nullable()->references("id")->on("sub_step_contents")->nullOnDelete();
            $table->foreignId("sub_step_tests_id")->nullable()->references("id")->on("sub_step_tests")->nullOnDelete();
            $table->foreignId("sub_step_video_id")->nullable()->references("id")->on("sub_step_video")->nullOnDelete();
            //Создал и обновил
            $table->foreignId("created_user")->nullable()->references("id")->on("users")->nullOnDelete();
            $table->foreignId("updated_user")->nullable()->references("id")->on("users")->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_content_stats');
    }
};
