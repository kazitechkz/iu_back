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
        Schema::create('utms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->references('id')->on('url_pages')->cascadeOnDelete();
            $table->integer('count');
            $table->date('visit_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utms');
    }
};
