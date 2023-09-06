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
        Schema::create('sub_step_contents', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("text_ru");
            $table->text("text_kk");
            $table->text("text_en")->nullable();
            $table->foreignId("sub_step_id")->references("id")->on("sub_steps")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('substep_contents');
    }
};
