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
        Schema::create('discusses', function (Blueprint $table) {
            $table->id();
            $table->text("text");
            $table->foreignId("user_id")
                ->nullable()
                ->references("id")
                ->on("users")
                ->cascadeOnDelete();
            $table->foreignId("forum_id")
                ->nullable()
                ->references("id")
                ->on("forums")
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
        Schema::dropIfExists('discusses');
    }
};
