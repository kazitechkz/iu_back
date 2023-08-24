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
        Schema::create('sub_tournament_rivals', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("rival_one")->references("id")->on("users")->cascadeOnDelete();
            $table->integer("point_one")->default(0);
            $table->integer("time_one")->default(0);
            $table->foreignId("rival_two")->references("id")->on("users")->cascadeOnDelete();
            $table->integer("point_two")->default(0);
            $table->integer("time_two")->default(0);
            $table->foreignId("winner")->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("sub_tournament_id")->references("id")->on("sub_tournaments")->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tournament_rivals');
    }
};
