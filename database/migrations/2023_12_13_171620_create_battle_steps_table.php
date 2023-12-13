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
            $table->string("promo_code");
            //Это Айди Битвы
            $table->foreignId("battle_id")->references("id")->on("battles")->cascadeOnDelete()->cascadeOnUpdate();
            //Это Айди Предмета
            $table->foreignId("subject_id")->nullable()->references("id")->on("subjects")->cascadeOnDelete()->cascadeOnUpdate();
            //Чья очередь
            $table->foreignId("current_user")->nullable()->references("id")->on("users")->cascadeOnDelete();
            //Завершился ли текущий этап
            $table->boolean("is_finished")->default(false);
            //Текущий ли этап
            $table->boolean("is_current")->default(false);
            //Последний ли этап
            $table->boolean("is_last")->default(false);
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
