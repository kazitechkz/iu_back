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
        Schema::create('tournament_locales', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("tournament_id")->references("id")->on("tournaments")->cascadeOnDelete();
            $table->foreignId("locale_id")->references("id")->on("locales")->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_locale');
    }
};
