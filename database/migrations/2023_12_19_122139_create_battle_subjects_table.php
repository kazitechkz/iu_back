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
        Schema::create('battle_subjects', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("step_id")->references("id")->on("battle_steps")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->json("subject_ids");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battle_subjects');
    }
};
