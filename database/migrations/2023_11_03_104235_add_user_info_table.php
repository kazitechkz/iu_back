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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId("image_url")->nullable()->references("id")->on("files")->onDelete("set null");
            $table->foreignId("gender_id")->nullable()->references("id")->on("genders")->onDelete("set null");
            $table->datetime("birth_date")->nullable();
            $table->text("info")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
