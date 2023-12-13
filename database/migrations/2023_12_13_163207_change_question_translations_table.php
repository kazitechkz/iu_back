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
        Schema::table('question_translations', function (Blueprint $table) {
            $table->foreignId('type_id')->after('subject_id')->references('id')->on('question_types')->cascadeOnDelete();
            $table->foreignId('group_id')->after('type_id')->references('id')->on('groups')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question_translations', function (Blueprint $table) {
            //
        });
    }
};
