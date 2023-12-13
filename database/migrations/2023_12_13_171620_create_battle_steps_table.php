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
        Schema::create('battle_steps', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("battle_id")->references("id")->on("battles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("subject_id")->references("id")->on("subjects")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("started_id")->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("finished_id")->nullable()->references("id")->on("users")->cascadeOnDelete();
            $table->integer("order");
            $table->boolean("is_finished")->default(false);
            $table->boolean("is_current")->default(false);
            $table->boolean("is_last")->default(false);
            $table->datetime("start_at");
            $table->datetime("end_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battle_steps');
    }
};
