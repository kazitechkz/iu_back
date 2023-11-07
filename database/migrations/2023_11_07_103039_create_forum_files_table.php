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
        Schema::create('forum_files', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("forum_id")
                ->nullable()
                ->references("id")
                ->on("forums")
                ->cascadeOnDelete();
            $table->foreignId("file_url")->references("id")->on("files")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_files');
    }
};
