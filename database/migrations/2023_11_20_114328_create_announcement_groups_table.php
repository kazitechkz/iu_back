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
        Schema::create('announcement_groups', function (Blueprint $table) {
            $table->id();
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->boolean("is_active");
            $table->foreignId("thumbnail")->nullable()->references("id")->on("files")->onDelete("set null");
            $table->datetime("start_date");
            $table->datetime("end_date");
            $table->integer("order")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement_groups');
    }
};
