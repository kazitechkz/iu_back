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
        Schema::create('tournament_steps', function (Blueprint $table) {
            $table->id();
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->integer("max_participants");
            $table->boolean("is_first")->default(false);
            $table->boolean("is_last")->default(false);
            $table->foreignId("prev_id")->nullable()->references("id")->on("tournament_steps")->cascadeOnDelete();
            $table->foreignId("next_id")->nullable()->references("id")->on("tournament_steps")->cascadeOnDelete();
            $table->integer("order");
            $table->boolean("is_playoff");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_step');
    }
};
