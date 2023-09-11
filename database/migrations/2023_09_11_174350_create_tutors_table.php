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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->unique()->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("image_url")->nullable()->references("id")->on("files")->onDelete("set null");
            $table->foreignId("gender_id")->nullable()->references("id")->on("genders")->onDelete("set null");
            $table->string("phone")->unique()->index();
            $table->string("email")->unique()->index();
            $table->string("iin")->unique()->index();
            $table->datetime("birth_date");
            $table->text("bio");
            $table->text("experience");
            $table->json("skills");
            $table->boolean("is_proved")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
