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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string("title",255)->index();
            $table->string("subtitle",255)->index();
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->foreignId('poster')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->foreignId('locale_id')->nullable()->references('id')->on('locales')->onDelete('set null');
            $table->text("description");
            $table->boolean("is_active")->default(true);
            $table->boolean("is_important")->default(false);
            $table->datetime("published_at");
            $table->foreignId("published_by")->nullable()->references('id')->on('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poster');
    }
};
