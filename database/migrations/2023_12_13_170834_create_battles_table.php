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
        Schema::create('battles', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("promo_code");
            $table->integer("price")->default(10);
            $table->string("pass_code")->nullable();
            $table->foreignId("owner_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("rival_id")->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("locale_id")->references("id")->on("locales")->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean("is_open")->default(false);
            $table->boolean("is_finished")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battles');
    }
};
