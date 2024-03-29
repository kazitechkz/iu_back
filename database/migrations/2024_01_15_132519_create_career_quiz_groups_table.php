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
        Schema::create('career_quiz_groups', function (Blueprint $table) {
            $table->id();
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->text("description_ru");
            $table->text("description_kk");
            $table->text("description_en")->nullable();
            $table->text("email")->nullable();
            $table->text("phone")->nullable();
            $table->text("address")->nullable();
            $table->integer("price")->default(0);
            $table->string("currency",20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_quiz_groups');
    }
};
