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
        Schema::create('steps', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("title_ru",255);
            $table->string("title_kk",255);
            $table->string("title_en",255)->nullable();
            $table->foreignId("subject_id")->references("id")->on("subjects")->cascadeOnDelete();
            $table->foreignId("category_id")->references("id")->on("categories")->cascadeOnDelete();
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on(config('subby.tables.plans'))
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer("level")->default(0);
            $table->boolean("is_free")->default(false);
            $table->boolean("is_active")->default(false);
            $table->foreignId('image_url')->nullable()->references('id')->on('files')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
