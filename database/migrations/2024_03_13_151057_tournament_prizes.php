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
        Schema::create('tournament_prizes', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->boolean("is_virtual")->default(false);
            $table->foreignId("tournament_id")->references("id")->on("tournaments")->cascadeOnDelete();
            $table->integer("order");
            $table->
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_prizes');
    }
};
