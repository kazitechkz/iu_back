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
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->text("text");
            $table->text("attachment");
            $table->foreignId("user_id")
                ->nullable()
                ->references("id")
                ->on("users")
                ->cascadeOnDelete();
            $table->foreignId("subject_id")
                ->nullable()
                ->references("id")
                ->on("subjects")
                ->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum');
    }
};
