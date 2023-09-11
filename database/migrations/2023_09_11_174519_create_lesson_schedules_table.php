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
        Schema::create('lesson_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tutor_id")->references("id")->on("tutors")->onDelete("NO ACTION");
            $table->timestamp("start_at");
            $table->timestamp("end_at");
            $table->float("price");
            $table->integer("amount")->default(1);
            $table->text("meeting_info");
            $table->foreignId("cancel_from")->nullable()->references("id")->on("lesson_schedules")->onDelete("NO ACTION");
            $table->boolean("is_cancelled")->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_schedules');
    }
};
