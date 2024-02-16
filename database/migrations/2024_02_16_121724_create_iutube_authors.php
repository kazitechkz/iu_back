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
        Schema::create('iutube_authors', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->text("name");
            $table->longText("description")->nullable();
            $table->text("instagram_url")->nullable();
            $table->text("vk_url")->nullable();
            $table->text("linkedin_url")->nullable();
            $table->text("facebook_url")->nullable();
            $table->text("tiktok_url")->nullable();
            $table->text("phone")->nullable();
            $table->text("email")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iutube_authors');
    }
};
