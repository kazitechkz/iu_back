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
        Schema::table('career_quiz_answers', function (Blueprint $table) {
            $table->foreignId("feature_id")->nullable()->references("id")->on("career_quiz_features")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_quiz_answers', function (Blueprint $table) {
            //
        });
    }
};
