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
        Schema::create('sub_steps', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->foreignId("step_id")->references("id")->on("steps")->cascadeOnDelete();
            $table->foreignId("sub_category_id")->references("id")->on("sub_categories")->cascadeOnDelete();
            $table->integer("level")->default(0);
            $table->boolean("is_active")->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('substeps');
    }
};
