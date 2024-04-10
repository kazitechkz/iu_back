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
        Schema::create('informations', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("alias");
            $table->foreignId("author_id")->references("id")->on("information_authors")->cascadeOnDelete();
            $table->foreignId("category_id")->references("id")->on("information_categories")->cascadeOnDelete();
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->text("seo_title");
            $table->text("seo_description");
            $table->text("seo_keywords");
            $table->text("title_ru");
            $table->text("title_kk");
            $table->longText("description_ru");
            $table->longText("description_kk");
            $table->boolean("is_active")->default(true);
            $table->boolean("is_main")->default(false);
            $table->dateTime("published_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informations');
    }
};
