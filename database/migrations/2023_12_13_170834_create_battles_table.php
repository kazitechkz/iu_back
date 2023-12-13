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
            $table->foreignId("guest_id")->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("winner_id")->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("locale_id")->references("id")->on("locales")->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer("owner_point")->default(0);
            $table->integer("guest_point")->default(0);
            $table->boolean("is_open")->default(true);
            $table->boolean("is_finished")->default(false);
            $table->datetime("start_at");
            $table->datetime("end_at")->nullable();
            $table->datetime("must_finished_at");
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
