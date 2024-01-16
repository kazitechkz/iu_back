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
        Schema::create('career_quiz_authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId("group_id")->references("id")->on("career_quiz_groups")->cascadeOnDelete();
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->string("name");
            $table->string("position_ru");
            $table->string("position_kk");
            $table->text("description_ru");
            $table->text("description_kk");
            $table->text("instagram_url")->nullable();
            $table->text("facebook_url")->nullable();
            $table->text("vk_url")->nullable();
            $table->text("linkedin_url")->nullable();
            $table->text("site")->nullable();
            $table->text("email")->nullable();
            $table->text("phone")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quiz_authors');
    }
};
