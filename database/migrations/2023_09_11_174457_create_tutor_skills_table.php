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
        Schema::create('tutor_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tutor_id")->references("id")->on("tutors")->cascadeOnDelete();
            $table->foreignId("subject_id")->references("id")->on("subjects")->cascadeOnDelete();
            $table->foreignId("category_id")->references("id")->on("categories")->cascadeOnDelete();
            $table->foreignId("sub_category_id")->references("id")->on("sub_categories")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_skills');
    }
};
