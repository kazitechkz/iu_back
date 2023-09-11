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
        Schema::create('lesson_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tutor_id")->nullable()->references("id")->on("tutors")->onDelete("NO ACTION");
            $table->foreignId("participant_id")->nullable()->references("id")->on("users")->onDelete("NO ACTION");
            $table->foreignId("schedule_id")->nullable()->references("id")->on("lesson_schedules")->onDelete("NO ACTION");
            $table->text("complaint");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_complaints');
    }
};
