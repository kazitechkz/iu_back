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
        Schema::create('tournament_awards', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->boolean("is_awarded")->default(false);
            $table->foreignId("tournament_id")->references("id")->on("tournaments")->cascadeOnDelete();
            $table->foreignId("sub_tournament_id")->references("id")->on("sub_tournaments")->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->integer("order");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_awards');
    }
};
