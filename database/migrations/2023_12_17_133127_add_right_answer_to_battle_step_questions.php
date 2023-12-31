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
        Schema::table('battle_step_questions', function (Blueprint $table) {
            $table->string("right_answer")->nullable()->after("answer");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('battle_step_questions', function (Blueprint $table) {
            $table->dropColumn("right_answer");
        });
    }
};
