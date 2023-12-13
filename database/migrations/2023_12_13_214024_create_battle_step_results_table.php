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
        Schema::create('battle_step_results', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("step_id")->references("id")->on("battle_steps")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("answered_user")->nullable()->references("id")->on("users")->nullOnDelete();
            $table->datetime("start_at");
            $table->datetime("end_at")->nullable();
            $table->boolean("is_finished")->default(false);
            $table->integer("result")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battle_step_results');
    }
};
