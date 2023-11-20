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
        Schema::create('announcements', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('type_id')->references('id')->on('announcement_types')->cascadeOnDelete();
            $table->foreignId('group_id')->references('id')->on('groups')->cascadeOnDelete();
            $table->foreignId("background")->nullable()->references("id")->on("files")->onDelete("set null");
            $table->string("title",255);
            $table->string("sub_title",255);
            $table->text("description")->nullable();
            $table->integer("time_in_sec")->default(15);
            $table->string("url_text")->nullable();
            $table->string("url")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
