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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("subject_id")->references("id")->on("subjects")->cascadeOnDelete();
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->text("rule_ru");
            $table->text("rule_kk");
            $table->text("rule_en")->nullable();
            $table->text("description_ru");
            $table->text("description_kk");
            $table->text("description_en")->nullable();
            $table->integer("price");
            $table->char("currency",10);
            $table->foreignId('poster')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->integer("status");
            $table->timestamp("start_at");
            $table->timestamp("end_at");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament');
    }
};
