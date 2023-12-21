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
        Schema::create('battle_bets', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("battle_id")->references("id")->on("battles")->cascadeOnDelete();
            $table->foreignId("owner_id")->references("id")->on("users")->cascadeOnUpdate();
            $table->foreignId("guest_id")->nullable()->references("id")->on("users")->nullOnDelete();
            $table->integer("owner_bet")->default(0);
            $table->integer("guest_bet")->default(0);
            $table->boolean("is_used")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battle_bets');
    }
};
