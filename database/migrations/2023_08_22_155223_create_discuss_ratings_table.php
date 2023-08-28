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
        Schema::create('discuss_rating', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer("rating")->nullable();
            $table->foreignId("user_id")
                ->nullable()
                ->references("id")
                ->on("users")
                ->cascadeOnDelete();
            $table->foreignId("discuss_id")
                ->nullable()
                ->references("id")
                ->on("discusses")
                ->cascadeOnDelete();
            $table->foreignId("forum_id")
                ->nullable()
                ->references("id")
                ->on("forum")
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
        Schema::dropIfExists('discuss_ratings');
    }
};
