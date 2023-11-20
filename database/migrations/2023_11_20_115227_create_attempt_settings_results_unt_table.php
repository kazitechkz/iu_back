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
        Schema::create('attempt_settings_results_unt', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("setting_id")->references("id")->on("attempt_settings_unt")->cascadeOnDelete();
            $table->foreignId("attempt_id")->references("id")->on("attempts")->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_settings_results_unt');
    }
};
