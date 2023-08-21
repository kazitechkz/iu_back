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
        Schema::create('appeals', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()
                ->references("id")->on("users")->nullOnDelete();
            $table->foreignId("type_id")->nullable()
                ->references("id")->on("appeal_types")->nullOnDelete();
            $table->foreignId("question_id")->nullable()
                ->references("id")->on("questions")->nullOnDelete();
            $table->string("message",255)->nullable();
            $table->integer("status")->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appeals');
    }
};
