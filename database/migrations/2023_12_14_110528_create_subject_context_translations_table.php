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
        Schema::create('subject_context_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('context_kk')->references('id')->on('subject_contexts')->cascadeOnDelete();
            $table->foreignId('context_ru')->references('id')->on('subject_contexts')->cascadeOnDelete();
            $table->foreignId('subject_id')->references('id')->on('subjects')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_context_translations');
    }
};
