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
        Schema::create('subject_contexts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->text('context');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_contexts');
    }
};
