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
        Schema::create('participant_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tutor_id")->references("id")->on("tutors")->cascadeOnDelete();
            $table->foreignId("participant_id")->references("id")->on("users")->onDelete("NO ACTION");
            $table->integer("rating")->nullable();
            $table->text("review")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_ratings');
    }
};
