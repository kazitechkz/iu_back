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
        Schema::create('commercial_groups', function (Blueprint $table) {
            $table->id();
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->char("tag",20)->unique();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commercial_group');
    }
};
