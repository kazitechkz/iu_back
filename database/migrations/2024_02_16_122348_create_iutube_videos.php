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
        Schema::create('iutube_videos', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("alias");
            $table->text("title");
            $table->longText("description")->nullable();
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->foreignId("author_id")->references("id")->on("iutube_authors")->cascadeOnDelete();
            $table->foreignId("locale_id")->references("id")->on("locales")->cascadeOnDelete();
            $table->foreignId("subject_id")->references("id")->on("subjects")->cascadeOnDelete();
            $table->foreignId("step_id")->nullable()->references("id")->on("steps")->nullOnDelete();
            $table->foreignId("sub_step_id")->nullable()->references("id")->on("sub_steps")->nullOnDelete();
            $table->text("video_url");
            $table->integer("price");
            $table->boolean("is_public");
            $table->boolean("is_recommended");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iutube_videos');
    }
};
