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
        Schema::create('sub_tournament_results', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("sub_tournament_id")->references("id")->on("sub_tournaments")->cascadeOnDelete();
            $table->integer("point")->default(0);
            $table->integer("time")->default(0);
            $table->foreignId("attempt_id")->references("id")->on("attempts")->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tournament_results');
    }
};
