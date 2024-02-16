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
        Schema::create('tournament_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->integer('order_id');
            $table->integer('price');
            $table->foreignId('tournament_id')->references('id')->on('tournaments')->cascadeOnDelete();
            $table->boolean('status')->default(false);
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_orders');
    }
};
