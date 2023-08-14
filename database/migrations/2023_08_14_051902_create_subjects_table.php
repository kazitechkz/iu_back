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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title_kk');
            $table->string('title_ru');
            $table->boolean('enable')->default(true);
            $table->boolean('is_compulsory')->default(false);
            $table->integer('max_questions_quantity');
            $table->integer('questions_step')->default(5);
            $table->foreignId('image_url')->nullable()->references('id')->on('files');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
